
@if(App\Models\Settings::get('GOOGLE_RECAPTCHA_ENABLED'))
    <div class="g-recaptcha"
        data-sitekey="{{App\Models\Settings::get('GOOGLE_RECAPTCHA_KEY')}}">
    </div>
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endif