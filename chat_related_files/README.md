# Group Chat Feature Integration Guide (with Pusher)

## 1. Required Files and Their Paths

Copy the following files and folders into the same relative locations in your Laravel project:

### Controllers
- app/Http/Controllers/ChatController.php

### Events
- app/Events/NewChatMessage.php

### Models
- app/Models/Message.php
- app/Models/GroupMembership.php
- app/Models/MyGroup.php

### WebSocket (Optional, if using custom server)
- app/WebSocket/ChatServer.php

### Routes
- routes/web.php (Add/merge chat-related routes)
- routes/channels.php (Add/merge group chat channel authorization)

### Views
- resources/views/chat/index.blade.php
- resources/views/layouts/group_admin.blade.php
- resources/views/layouts/group_member.blade.php
- resources/views/groups/partials/admin_sidebar.blade.php

### Frontend JS
- resources/js/app.js (Ensure Echo and Pusher setup is present)

### Configuration
- config/pusher.php
- config/broadcasting.php

### Service Provider
- app/Providers/BroadcastServiceProvider.php

### Environment Variables
Add the following to your .env file:
```
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_APP_CLUSTER=your_cluster
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
```

---

## 2. Dependencies

### Backend (PHP Composer)
```
composer require pusher/pusher-php-server
```

### Frontend (NPM/Yarn)
```
npm install laravel-echo pusher-js
# or
yarn add laravel-echo pusher-js
```

---

## 3. Configuration

### config/broadcasting.php
Ensure the `pusher` connection is set up:
```php
'default' => env('BROADCAST_DRIVER', 'pusher'),
'connections' => [
    'pusher' => [
        'driver' => 'pusher',
        'key' => env('PUSHER_APP_KEY'),
        'secret' => env('PUSHER_APP_SECRET'),
        'app_id' => env('PUSHER_APP_ID'),
        'options' => [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ],
    ],
    // ... other connections
],
```

### config/pusher.php
```php
return [
    'app_id' => env('PUSHER_APP_ID'),
    'key' => env('PUSHER_APP_KEY'),
    'secret' => env('PUSHER_APP_SECRET'),
    'options' => [
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'useTLS' => true,
    ],
];
```

---

## 4. Frontend Setup

### resources/js/app.js
Make sure you have:
```js
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY || 'your_app_key',
    cluster: process.env.MIX_PUSHER_APP_CLUSTER || 'your_cluster',
    forceTLS: true,
});
```

### resources/views/chat/index.blade.php
Ensure you include the Pusher JS library and the correct JavaScript for real-time chat.

---

## 5. Routes

### routes/web.php
Add:
```php
Route::get('/groups/{groupId}/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/groups/{groupId}/chat', [ChatController::class, 'store'])->name('chat.store');
```

### routes/channels.php
Add:
```php
Broadcast::channel('group.{groupId}', function ($user, $groupId) {
    return \App\Models\GroupMembership::where('user_id', $user->id)
        ->where('group_id', $groupId)
        ->exists();
});
```

---

## 6. Service Provider

### app/Providers/BroadcastServiceProvider.php
Ensure it contains:
```php
public function boot(): void
{
    Broadcast::routes();
    require base_path('routes/channels.php');
}
```

---

## 7. Database

Make sure the following tables exist (with appropriate columns):
- messages
- my_group
- group_memberships

If not, copy the relevant migration files from your project.

---

## 8. Build Assets

After copying files and installing dependencies, run:
```
npm install
npm run build   # or npm run dev for development
```

---

## 9. Queue Worker (for broadcasting events)

If using Laravel broadcasting with queues, start the queue worker:
```
php artisan queue:work
```

---

## 10. Final Checklist

- [ ] All files copied to correct locations
- [ ] Composer and NPM dependencies installed
- [ ] Environment variables set
- [ ] Database tables present
- [ ] Assets built
- [ ] Queue worker running (if needed)
- [ ] Pusher credentials valid

---

## 11. Testing

1. Visit `/groups/{groupId}/chat` in your browser.
2. Open the same page in another browser/user.
3. Send a message and confirm it appears in real-time for both users.

---

**If you need further help, see the main project documentation or contact the original developer.** 