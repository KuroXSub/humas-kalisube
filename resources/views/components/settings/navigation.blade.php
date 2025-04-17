@props(['active' => 'profile'])

@php
    $initial = strtoupper(substr(auth()->user()->name, 0, 1));
@endphp

<div class="settings-nav-container">
    <div class="settings-nav-user">
        <div class="settings-nav-avatar">
            {{ $initial }}
        </div>
        <div class="settings-nav-user-info">
            <h3>{{ auth()->user()->name }}</h3>
            <p>{{ auth()->user()->email }}</p>
        </div>
    </div>
    
    <nav class="settings-nav-links">
        <a href="{{ route('settings.profile') }}" 
           class="settings-nav-link {{ $active === 'profile' ? 'settings-nav-link-active' : 'settings-nav-link-inactive' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="settings-nav-icon" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            Profile
        </a>
        <a href="{{ route('settings.password') }}" 
           class="settings-nav-link {{ $active === 'password' ? 'settings-nav-link-active' : 'settings-nav-link-inactive' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="settings-nav-icon" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
            Password
        </a>
        <a href="{{ route('settings.appearance') }}" 
           class="settings-nav-link {{ $active === 'appearance' ? 'settings-nav-link-active' : 'settings-nav-link-inactive' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="settings-nav-icon" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
            </svg>
            Appearance
        </a>
    </nav>
</div>