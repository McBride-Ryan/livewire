<form wire:submit.prevent="register">
    {{-- <div>
        <label for="name">Name</label>
        <input wire:model="name" type="name" id="name" name="name">
        @error('name')
            <span class="text-red-500 text-sm">{{$message}}</span>
        @enderror
    </div> --}}
    <div>
        <label for="email">Email</label>
        <input wire:model="email" type="email" id="email" name="email">
        @error('email')
            <span class="text-red-500 text-sm">{{$message}}</span>
        @enderror
    </div>
    <div>
        <label for="password">Password</label>
        <input wire:model="password" type="password" id="password" name="password">
        @error('password')
            <span class="text-red-500 text-sm">{{$message}}</span>
        @enderror
    </div>
    <div>
        <label for="passwordConfirmation">Password Confirmation</label>
        <input wire:model="passwordConfirmation" type="password" id="passwordConfirmation" name="passwordConfirmation">
        @error('passwordConfirmation')
            <span class="text-red-500 text-sm">{{$message}}</span>
        @enderror
    </div>
    <div>
        <input type="submit" value="Register">
    </div>
</form>