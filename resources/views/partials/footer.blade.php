<footer class="footer mt-auto py-3 bg-light">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <h3>{{ settings('name') }}</h3>
        <p>{{ settings('address') }}</p>
        <p>{{ settings('email') }}</p>
        <p>{{ settings('contact') }}</p>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">

      </div>
      <div class="col-lg-4 col-md-4 col-sm-12"></div>
    </div>
    <div class="text-muted  text-center"> &copy; {{ date('Y') }} {{ settings('name') }}</div>

  </div>

</footer>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>