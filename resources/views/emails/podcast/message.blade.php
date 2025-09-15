@component('mail::message')
# New Podcast Created 🎙️

A new podcast entry has been submitted.

- **Name:** {{ $name }}
- **Email:** {{ $email }}
- **Company:** {{ $company ?? 'N/A' }}
- **Message:**  
{{ $msg ?? 'No message provided' }}

@component('mail::button', ['url' => config('app.url')])
View App
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
