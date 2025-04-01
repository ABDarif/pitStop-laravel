<x-mail::message>
# Congrats, {{ $appointment->last_name }}! Your appointment is successfully posted <br>

This will be verified by the admins shortly! <br>

Your Appointment Details: <br>
Car License No: {{ $appointment->car_license }} <br>
Car Engine No: {{ $appointment->car_engine }} <br>
Appointment Date: {{ $appointment->appointment_date }} <br>
Preferred Mechanic: {{ $appointment->mechanic }}

<x-mail::button :url="''">
View Appointment Details
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
