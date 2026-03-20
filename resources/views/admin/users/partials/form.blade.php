<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required placeholder="{{ __('Name') }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <label for="email">{{ __('Email Address') }}</label>
            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required placeholder="{{ __('Email Address') }}">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input class="form-control" type="password" name="password" id="password" autocomplete="new-password">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <label for="password">{{ __('Confirm Password') }}</label>
            <input class="form-control" type="password" name="confirm-password" id="confirm-password" autocomplete="new-password">
            @error('confirm-password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="role">Seleccionar Rol</label>
            <div class="mt-2">
                @foreach ($roles as $role)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="role_{{ $role->id }}" value="{{ $role->id }}"
                            {{ isset($userRole) ? ($role->id == $userRole ? 'checked' : '') : '' }}>
                        <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                    </div>
                @endforeach
            </div>
            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
