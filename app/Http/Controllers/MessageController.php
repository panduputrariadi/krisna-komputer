<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Cashier;
use App\Models\Message;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewMessageNotification;

class MessageController extends Controller
{
    public function readMessageAdmin(Request $request)
    {
        $user = auth()->user();
        $adminRoleId = 1;
        $customers = User::where('role_id', '!=', $adminRoleId)->get();

        $messages = Message::where('sender_id', $user->id)
            ->orWhere('reciever_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();

        $timezone = 'Asia/Makassar';
        $messages = $messages->map(function ($message) use ($timezone) {
            $message->created_at = Carbon::parse($message->created_at)->timezone($timezone);
            return $message;
        });

        $chart = Cashier::all();
        $category = Category::all();
        if ($request->ajax()) {
            return view('partials.message_content', compact('chart', 'category', 'messages', 'customers'))->render();
        }

        return view('User.CustomerMessage', compact('chart', 'category', 'messages', 'customers'));
    }

    public function sendMessageToAdmin(Request $request)
    {
        $validated = $request->validate([
            'content' => 'nullable|string',
        ]);

        $sender = auth()->user()->id;
        $receiver = 1;
        $currentDateTime = Carbon::now();

        $message = Message::create([
            'sender_id' => $sender,
            'reciever_id' => $receiver,
            'content' => $validated['content'],
            'created_at' => $currentDateTime
        ]);

        $message->save();

        dispatch(function () use ($message) {
            $this->sendEmailNotification($message);
        })->onQueue('emails');

        return response()->json(['success' => true, 'message' => $message]);
    }

    protected function sendEmailNotification(Message $message)
    {
        $adminEmail = 'put.rariadi1144@gmail.com';

        dispatch(function () use ($adminEmail, $message) {
            $user = auth()->user();
            Mail::to($adminEmail)->send(new NewMessageNotification($user, $message));
        })->onQueue('emails')->delay(now()->addMinutes(1));
    }

    public function getNewMessages(Request $request)
    {
        try {
            $user = auth()->user();

            $lastCheckedTime = Carbon::parse($request->input('lastCheckedTime'))
                ->setTimezone(config('app.timezone'));

            $messages = Message::where('reciever_id', $user->id)
                ->where('created_at', '>', $lastCheckedTime)
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json(['messages' => $messages]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function readMessageCustomer()
    {
        $user = auth()->user();
        $adminRoleId = 1;

        $customers = User::where('role_id', '!=', $adminRoleId)->get();
        $status = Cashier::COMPLETE;

        $count = Cashier::with('product')->where('status', $status)
            ->sum('total');
        $countItems = Product::sum('stok');

        $messages = [];
        foreach ($customers as $customer) {
            $customerMessages = Message::where(function ($query) use ($user, $customer) {
                $query->where('sender_id', $customer->id)->where('reciever_id', $user->id)
                    ->orWhere('sender_id', $user->id)->where('reciever_id', $customer->id);
            })->get();
            $customerMessages->transform(function ($message) {
                $message->created_at = $message->created_at->setTimezone('Asia/Makassar');
                return $message;
            });

            $messages[$customer->id] = $customerMessages;
        }

        $customer->photo = $customer->photo;
        $messages[$customer->id] = $customerMessages;

        return view('Admin.AdminInbox', compact('messages', 'count', 'countItems', 'customer', 'customers'));
    }

    public function readNewMessagesCustomer(Request $request)
    {
        $user = auth()->user();
        $adminRoleId = 1;

        $keyword = $request->keyword;
        $customers = User::where('role_id', '!=', $adminRoleId)->get();
        $status = Cashier::COMPLETE;

        $count = Cashier::with('product')->where('status', $status)->sum('total');
        $countItems = Product::sum('stok');

        $messages = [];
        foreach ($customers as $customer) {
            $customerMessages = Message::where(function ($query) use ($user, $customer, $request) {
                $query->where('sender_id', $customer->id)
                    ->where('reciever_id', $user->id)
                    ->orWhere('sender_id', $user->id)
                    ->where('reciever_id', $customer->id)
                    ->where('created_at', '>', $request->input('lastCheckedTime'));
            })->get()->where('name', 'LIKE', '%'. $keyword . '%');

            $customerMessages->transform(function ($message) {
                $message->created_at = $message->created_at->setTimezone('Asia/Makassar');
                return $message;
            });
            $messages[$customer->id] = $customerMessages;
        }

        return response()->json(['messages' => $messages]);
    }


    public function sendMessageToCustomer(Request $request)
    {
        $validated = $request->validate([
            'content' => 'nullable|string'
        ]);

        $sender = auth()->user()->id;
        $recieverId = $request->input('reciever_id');

        $message = Message::create([
            'sender_id' => $sender,
            'content' => $validated['content'],
            'reciever_id' => $recieverId,
        ]);

        return response()->json(['success' => true, 'message' => $message]);
    }
}
