<div class="row">
    <style>
        .height-input {
            height: calc(1.8125rem + 0.75rem) !important;
            padding: 0.375rem 0.75rem !important;
        }
    </style>
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
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <label for="role_id">Seleccionar Rol</label>
            <select class="form-control height-input @error('role_id') is-invalid @enderror" name="role_id" id="role_id" required>
                <option value="">-- Seleccionar Rol --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', $userRole) == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
