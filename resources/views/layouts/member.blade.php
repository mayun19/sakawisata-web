<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SAKAWISATA - @yield('title')</title>
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
  </head>

  <body>
    @include('includes.navbar') 

    <div class="section-content member-info">
      <div class="container ">
        @yield('konten')
      </div>
    </div>

    @include('includes.footer-alternate')
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
  </body>

</html>
