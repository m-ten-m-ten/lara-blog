@if ($errors->any())
  <div class="m-error">
    <ul>
      @foreach ( $errors->all() as $error )
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif