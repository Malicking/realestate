<div class="widget-content">
    <ul class="category-list ">
        <li class="current">
            <a href="{{ route('dashboard') }}">
                <i class="fab fa fa-th "></i> Tableau de bord
            </a>
        </li>
        <li>
            <a href="{{ route('user.profile') }}">
                <i class="fa fa-cog" aria-hidden="true"></i> Paramètres
            </a>
        </li>

        @php
            $auth_id = Auth::id();
            $schedules = App\Models\Schedule::where('user_id', $auth_id)->get();
        @endphp

        <li>
            <a href="{{ route('user.schedule.request') }}">
                <i class="fa fa-credit-card" aria-hidden="true"></i> Demandes de visite
                <span class="badge badge-info" style="font-size: 60%;">({{ count($schedules) }})</span>
            </a>
        </li>
        <li>
            <a href="{{ route('live.chat') }}">
                <i class="fa fa-comments" aria-hidden="true"></i></i> Chat Live
            </a>
        </li>
        <li>
            <a href="{{ route('user.wishlist') }}">
                <i class="fa fa-indent" aria-hidden="true"></i> Ma wishlist
            </a>
        </li>
        <li>
            <a href="{{ route('user.compare') }}">
                <i class="fa fa-indent" aria-hidden="true"></i> Mes comparaisons
            </a>
        </li>
        <li>
            <a href="{{ route('user.change.pwd') }}">
                <i class="fa fa-key" aria-hidden="true"></i> Sécurité
            </a>
        </li>
        <li>
            <a href="{{ route('user.logout') }}">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Se déconnecter
            </a>
        </li>
    </ul>
</div>
