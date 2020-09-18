<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item @if(Request::is('booking*'))
                              active
                          @endif">
        <a class="nav-link" href="/bookings">Booking @if(Request::is('bookings*'))
                                <span class="sr-only">(current)</span>
                            @endif </a>
      </li>
      <li class="nav-item @if(Request::is('foods*'))
                              active
                          @endif">
        <a class="nav-link" href="/foods">Makanan @if(Request::is('foods*'))
                                <span class="sr-only">(current)</span>
                            @endif </a>
      </li>
      <li class="nav-item @if(Request::is('components*'))
                              active
                          @endif">
        <a class="nav-link" href="/components">Komponen @if(Request::is('components*'))
                                <span class="sr-only">(current)</span>
                            @endif </a>
      </li>
      <li class="nav-item @if(Request::is('reminders*'))
                              active
                          @endif">
        <a class="nav-link" href="/reminders">Reminder @if(Request::is('reminders*'))
                                <span class="sr-only">(current)</span>
                            @endif </a>
      </li>
      <li class="nav-item @if(Request::is('engineers*'))
                              active
                          @endif">
        <a class="nav-link" href="/engineers">Teknisi @if(Request::is('engineers*'))
                                <span class="sr-only">(current)</span>
                            @endif </a>
      </li>
    </ul>
  </div>
</nav>
