<x-mail::message>
# New Contact Message Received

You have received a new message from your website contact form.

---

**Name:** {{ $contact->name }}  
**Email:** {{ $contact->email }}  
**Country Code:** {{ $contact->country_code ?? 'N/A' }}  
**Mobile:** {{ $contact->mobile ?? 'N/A' }}  
**Company:** {{ $contact->company ?? 'N/A' }}  
**Countryname:** {{ $contact->country_name ?? 'N/A' }} 

---

**Message:**  
{{ $contact->message ?? 'No message provided' }}

<x-mail::button :url="url('/')">
Go to Website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
