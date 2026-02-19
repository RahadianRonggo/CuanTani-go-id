<nav>
    <a href="{{ route('vault') }}">01.VAULT</a>
    <a href="{{ route('audit') }}">02.AUDIT</a>
    <a href="{{ route('paper') }}" class="{{ request()->is('paper') ? 'active' : '' }}">03.PAPER</a>
    <a href="{{ route('shield') }}">04.SHIELD</a>
    <a href="{{ route('lab') }}">05.LAB</a>
</nav>