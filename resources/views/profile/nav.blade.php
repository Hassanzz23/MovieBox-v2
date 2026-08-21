<div class="border-bottom mb-4">

    <ul class="nav nav-tabs">

        <li class="nav-item">
            <a href="{{ route('profile.index') }}"
                class="nav-link {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                Profile
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('watchlist.index') }}"
                class="nav-link {{ request()->routeIs('watchlist.index') ? 'active' : '' }}">
                My WatchList
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('favorites.index') }}"
                class="nav-link {{ request()->routeIs('favorites.index') ? 'active' : '' }}">
                Favorites
            </a>
        </li>

    </ul>

</div>
