@props(['user' => null])

<div class="row g-3">
    <!-- Name -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="name" class="required-field">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" 
                   value="{{ old('name', $user?->name) }}" required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Email -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="email" class="required-field">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                   id="email" name="email" 
                   value="{{ old('email', $user?->email) }}" required>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Password -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="password" class="{{ !$user ? 'required-field' : '' }}">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   id="password" name="password" 
                   {{ !$user ? 'required' : '' }}>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            @if($user)
                <small class="text-muted">Leave blank to keep current password</small>
            @endif
        </div>
    </div>

    <!-- Password Confirmation -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="password_confirmation" class="{{ !$user ? 'required-field' : '' }}">Confirm Password</label>
            <input type="password" class="form-control" 
                   id="password_confirmation" name="password_confirmation"
                   {{ !$user ? 'required' : '' }}>
        </div>
    </div>

    <!-- Role -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="role" class="required-field">Role</label>
            <select class="form-select @error('role') is-invalid @enderror" 
                    id="role" name="role" required>
                <option value="user" {{ old('role', $user?->role) === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role', $user?->role) === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Status -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="is_active" class="required-field">Status</label>
            <select class="form-select @error('is_active') is-invalid @enderror" 
                    id="is_active" name="is_active" required>
                <option value="1" {{ old('is_active', $user?->is_active) ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active', $user?->is_active) ? '' : 'selected' }}>Inactive</option>
            </select>
            @error('is_active')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div> 