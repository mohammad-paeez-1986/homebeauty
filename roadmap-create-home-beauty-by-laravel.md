create APP_KEY after install, used for encryption (sessions, cookies, password hashing, etc.).
    php artisan key:generate

list of php extentions
    php -m
    php -m | grep pdo_mysql
    php -m | grep '^x'

init migration
    pa migrate
    (without may cause error)

install livewire
    composer require livewire/livewire

install tailwind
    npm install -D tailwindcss postcss autoprefixer
    npx tailwindcss init -p
    npm run build -- create css

run:
    composer run dev
    (maybe need APP_URL=http://127.0.0.1:8000)

create main layout by cli
    pa livewire:layout

create single file component
    pa make:livewire counter
    (it create resources/views/components/⚡counter.blade.php)

create a route to load component
    Route::livewire('/counter', 'counter');

vars in component
    public $count = 1; -- share with front
    show: {{ $count }}, {{ $this->count }}

action
    public function increment() { $this->count++; }
    wire:click='increment'
    - with params
    wire:click='increment(1)'
    wire:click='increment([1, 2, 4])'

load component in blade files
    'comments' is component name in views/components
        <livewire:comments name="mona" />
    if value is var
        <livewire:comments :comments="$comments" />
    with blade directive
        @livewire('comments', ['comments' => $comments])
    in other namespaces
        <livewire:pages::user.profile :user="$user"/>

props in component
    <livewire:comments name="mona" />
    public $name; if init like public $name='anything'; not overwrite
    (but in mount() or boot() methods $this->name = 'new name' overwrite)
    prop will send automatically in mount method with the same name
    <livewire:comments name="mona" :book="$book"/>
    mount($name, Book $book)


locked (not change by front live)
    use Livewire\Attributes\Locked;
    #[Locked]
    public $postId;  // Cannot be changed by the frontend, server side only
    (with action can change it, with wire:model.live not)

How can change public property by front?
    <input type="text" wire:model.live='name'/> -- when change rerender front all, (run boot() again)
    - binding
        wire:model -- when change update front, but in next rerender its changed
        wire:model.live.blur -- after blur rerender
    -
    wire:keydown='action', wire:keydown.enter='action' // key down is one step behind aas in field but in front aa
    wire:keydown.enter.prevent // prevent submit by enter an input
    wire:keyup -- its not behind
    wire:click='action'
    wire:model.live.debounce.250ms

form
front:
    <form wire:submit.prevent="save">
    <input type="text" wire.model="name">
    @error('name') <span>{{ $message }}</span> @enderror
back:
    public $name; -- can be inited
    - validate rule by arrtibute
    #[Validate('required|min:3')]
    public $name;
    public function save() {
        $this->validate(); -- then we can use @error in front
        $this->validate(['title' => 'required|min:5'])
        $validated = $this->validate(); --> Post::create($validated);
    }
    (by Validate attribute validation run after update var without $this->validate() run) 
    - validation by $rules property
    public $rules = ['name' => 'required|min:3', ...]
    - validation by rules protected method
    protected function rules() => ['name' => 'required|min:3', ...]
    $rules and rules() will check after run $this->validated();
    - real time validation
        with Validate attribute used.
            (this ways show error after submit, we can have live error by 
            wire:model.live or wire:model.live.blur, wire:model.live.debounce.250ms)
        with $rules, rules()
            updated($property) => $this->validateOnly

show loading
    <div wire:loading>show in every ajax</div>
    <div wire:loading wire:target="save">show when save action called</div> --- wire:target="save, delete"
    - track property for loading
        wire:model <div wire:loading wire:target="count"> work for binded prop
a way to disable on change class when loading
    <button wire:click="save" wire:loading.attribute="disabled" wire:loading.class="opacity-50" wire:target="save">Save</button>
spin beside into submit button
    <button type='submit'>Save <p wire:loading.delay wire:target="save" class='animate-spin'>*</p> </button>
two part
    <button wire:click="save">
        <span wire:loading.remove>Save</span>
        <span wire:loading>Saving...</span>
    </button>
delay (use on fast requests)
    wire:loading.delay
    wire:loading.short more 200ms
    wire:loading.long more 500ms
reset
    $this->reset('title', 'name')
    (if have $count public and not on form and run $this->reset() $count will be reset too)
    $this->resetExcept('count')
validated data
    $dataWhichHasValidationAndValidated = $this->validate()
public vars methods
    $this->all() -- all publics
    $this->only('title', 'name')
    $this->fill(['name' => 'My_name', 'title' => 'Title']), $this->fill($post->only(['title', 'content']))

updated(The Post-Update Hook)
    updated($property, $value)
    (when run? wire:model.live on input, wire:model + form submit, not run if change by action or direct in php,
    when frontend change that will be fired (or updatedAge))
    (not run if dynamically change value like button click and $this->title = 'new title')
    (when use? we want to transform ucfirst like, or we want custom logic on it like custom validation,
    show another field)
    - specific
    updatedSearchQuery($value) ->  $this->searchResults = Product::where('name', 'like', "%{$value}%")->get();
updating(The Pre-Update Hook)
    Use this when you need to modify the incoming value before it's saved to your public property
    works with wire live types

add error
    $this->addError('title', 'Email addresses from banned.com are not allowed.');
    show @error('title') <span>{{ $message }}</span> @enderror

#Namespace
    pa make:livewire counter -> resources/views/components/⚡counter.blade.php
    pa make:livewire pages::index -> resources/views/pages/⚡counter.blade.php 
    for nested pages::users.profile -> resources/views/pages/users/⚡profile.blade.php 
    -- pages is setted in config file, to publish config file pa livewire:config || php artisan livewire:publish
    - route
    Route::livewire('/books', 'pages::books.index'); -- views/pages/book/index.blade.php

mount()
    init
        - load from another component <livewire:posts.edit :post="$post">
        - backend: public $title; public $content; mount(Post $post) { $this->title = $post->title; ...}
    where use (when wnat to do logig like validation, transform, check permission)
        protected $excelService; mount(ExcelService $excelService) { $this->excelService = $excelService}
        public $title, public $content; mount(Post $post) => $this->title = $post->title; $this->content = $post->content;
        mount($postId) => $this->post = Post:find($postId)
    
When to use protected properties:
    protected PaymentService $paymentService;
    public function mount(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    Why protected? The service should never be serialized to the frontend or tampered with via JavaScript.
    when want to use it in back part only.

States and Props
    public $user = User::find(1); is invalid
    public function mount() => $this->user = User::find(1);

The error: "Property type not supported in Livewire for property: [{}]" happens because Livewire tries to serialize every public property to send it to the frontend.
the service object is not serializable (it may contain database connections, file handles, closures, service, etc)
(use protected for it)

Eloquent object will serialize like:
    "user":[null, {"class":"App\Models\User", "key":1, "s":"mdl"}] and in every request will be query again,
    even in declared in mount() method like $this->user = User::find(1)
    1 database fetch on initial load, then 1 fetch on every subsequent Livewire request (rehydration).

Computed
public User $user; mount() => $this->user = User::find(1) 
#[Computed] user() => return User::find(1)
and front is
{{$this->user->name}} {{$this->user->email}}
both run 1 query after any request, but when should use computed??
computed property will not serialize to front in any case, it will stay server side
- Conditional usage:
@if($someCondition)
    {{ $this->user->name }}   <!-- Query runs only if condition is true -->
@endif
- Reactive dependencies
    our id is not static, in this case user by id 1, its dynamic
    public $userId;
    User::find($this->userId)
    if use public $userId; with mount() => User::find($this->userId) it will create  "user":[null, {"class":"App\Models\User", "key":1, "s":"mdl"}]  
    and with update $userId serialize key will not update. and we will need to updatedUserId($value) => ...
    but if use computed because it will re run after any request, for example if change $userId it will run again.
pf getTotalProperty()

in collection like $posts = Post::all() then 
$posts->count() or $post->avg('price') will not requery it will use $posts data
therefor if use computed every time use $this->posts in front in this process
it will used cached even $this->posts->count() but with using  public and mount it will use 
mini-serialized to requery every access $posts and mini serialized will be heavier like
"user":[null, {"class":"App\Models\User", "keys":[1, .... , 100], "s":"mdl"}]

Run method in blade
    {{ $this->method(2) }}

wire:show
    <div wire:show="!isLoggedIn">Guest</div>
    <div wire:show="isLoggedIn">User</div>
    wire:show="userRole === 'admin'"
    <div wire:show="isLoading">...
    <div wire:show="!isLoading && data">...

wire:text
    <span wire:text="status === 'active' ? 'active' : 'inactive'"></span>
    <span wire:text="js expression"></span>
    <span wire:text="search.length"></span>

Class
    class="{{ $status === 'active' ? 'text-green-600' : 'text-red-600' }}"
    {{ $isActive && 'text-green'}} not work because this will return boolean in php but in js return 'text-green'
    wire:
    @class(['bg-red' => $isActive])
    <p wire:bind:class="isHovering && 'bg-red-600'">Dynamic link se</p> -- it works


wire:bind
    html tag attribute (class, style, disabled, href, checked, ...) bind with
    component property, which shared with front public
    - examples
        wire:bind:class="search.length > 5 && 'border-green-500'"
        wire:bind:disabled="isLoading"
        <span wire:text="search.length > 0 ? 'Active' : 'Inactive'"></span>
    (not for input like wire:model)

x-on:click="$wire.likes++" will work (or @click) but
wire:click sends the string "$wire.likes++" to the server as a method name, which doesn't exist.
wire:click="$set('showBulkBar', true)" will works

$wire
    remote for component from js
    @click="$wire.method()"
    $wire is javascript var
    $wire.name = 'ali'

 when a prop is changed in front by wire:model and not component rerendered to save an go to snapshop,
    its dirty
    <div wire:show="$dirty('name')" class="text-yellow-500">
        ⚠️ Unsaved changes
    </div>
     <button wire:click="save" wire:show="$dirty('name')">
        Save
    </button>

When something updated in front like:
    wire:model
    $wire.name = ''
    - not rerender component
    - not change {{$name}}
    - @click='console.log(name)' show change
    - not run updated
When updated runs?
    when there is change in front and not updated in server side,
    and something cause rerender. 
What cause rerender?
    wire:submit="save"
    wire:click="action"
    $set('name', 'new name')
    wire:model.live, blur
    wire:model.change="category" 
    dispatch an event
    $wire.refresh()

wire:ref
    - wire:ref="messageBox"
        access in js: $this.refs.messageBox
        access in blade: $refs.messageBox.focus()
    <livewire:modal wire:ref="myModal" />
    now can access to modal component prop and methods
    $refs.myModal.$wire.close()
    @click="$refs.myModal.$wire.message = 'Hello from parent!'"

@island
if a UI chunk can update independently, it should be an island.
when a component re-render, itself and not childs, even send prop and prop change in parent.
<action="">
@island
heavy things like fetch, chart fetch,
<button type="button" wire:click="$refresh">Refresh</button> -- can refresh this part
@endiland
-- access out of island
@island(name:"incomeLand")
<button wire:click="$refresh" wire:island="incomeLand">

@island(lazy: true)
    heavy things
@else
    <div class="animate-pulse bg-gray-200 h-48 rounded-lg">
        <p class="p-4 text-gray-500">Loading report...</p>
    </div>
@endisland


$toggle()
public $active = false;
wire:click="$toggle('active')"
class="px-4 py-2 rounded {{ $enabled ? 'bg-green-500' : 'bg-gray-300' }}"

-----------------------------------------------------------------------------------------------------
wire:bind:class="day === '{{ $dayOption['date'] }}' && '!border-amber-400 bg-amber-50 text-amber-700'"

<div x-data="{ 
    isSelected: $wire.time === '{{ $timeOption['value'] }}',
    isDisabled: {{ $timeOption['value'] === '09:00' ? 'true' : 'false' }}
}"
    class="text-center p-2 border border-gray-200 transition-all text-md font-normal"
    :class="{
        '!border-amber-400 bg-amber-50 text-amber-700': isSelected && !isDisabled,
        'opacity-20 cursor-not-allowed': isDisabled,
        'cursor-pointer hover:border-amber-400': !isDisabled && !isSelected
    }"
>
    {{ $timeOption['label'] }}
</div>

 wire:bind:class="
        (time === '{{ $timeOption['value'] }}' ? '!border-amber-400 bg-amber-50 text-amber-700' : '') +
        ({{ $timeOption['value'] === '09:00' ? 'true' : 'false' }} ? ' opacity-20' : '')
"

dispatch an event in php and listen in js
    $this->dispatch('event-name')
    Livewire.on('event-name', function() {
    })
with data
    $this->dispatch('event-name', user:$user, age:20)
    (e) => e.name