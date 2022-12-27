<li class="nav-item">
    <a href="{{ route('subscribers.index') }}"
       class="nav-link {{ Request::is('subscribers*') ? 'active' : '' }}">
        <p>Subscribers</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('blogs.index') }}"
       class="nav-link {{ Request::is('blogs*') ? 'active' : '' }}">
        <p>Blogs</p>
    </a>
</li>


