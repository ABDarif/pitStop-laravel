<x-layout>
    <x-slot:heading>
        Edit Appointment for <b><i>{{ $appointment->first_name }} {{ $appointment->last_name }}</i></b> on <b><i>{{ $appointment->appointment_date }}</i></b>
    </x-slot:heading>
    <x-slot:nav>
        <x-nav-link href="/admin" :active="request()->is('/admin')">Admin_index</x-nav-link>
        <x-nav-link href="/admin/show" :active="request()->is('/admin/show')">Admin_show</x-nav-link>
    </x-slot:nav>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <form method="POST" action="/appointments/{{ $appointment->id }}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-2">
                <label for="first_name" class="block text-sm/6 font-medium text-gray-900">Name</label>
                <h3>{{ $appointment->first_name }} {{ $appointment->last_name }}</h3>
              </div>

              <div class="sm:col-span-2">
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                <h3>{{ $appointment->email }}</h3>
              </div>

              <div class="sm:col-span-2">
                <label for="phone" class="block text-sm/6 font-medium text-gray-900">Phone</label>
                <h3>{{ $appointment->phone }}</h3>
              </div>

              <div class="col-span-full">
                <label for="address" class="block text-sm/6 font-medium text-gray-900">Address</label>
                <h3>{{ $appointment->address }}</h3>
              </div>
            </div>
          </div>
        </div>

        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Vehicle Information</h2>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-3">
                <label for="car_license" class="block text-sm/6 font-medium text-gray-900">License No.</label>
                <h1>{{ $appointment->car_license }}</h1>
              </div>

              <div class="sm:col-span-3">
                <label for="car_engine" class="block text-sm/6 font-medium text-gray-900">Engine No.</label>
                <h1>{{ $appointment->car_engine }}</h1>
              </div>
            </div>
          </div>
        </div>

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Appointment & Mechanic Information</h2>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2">
                        <label for="appointment_date" class="block text-sm/6 font-medium text-gray-900">Update appointment date</label>
                        <div class="mt-2 grid grid-cols-1">
                            <input type="date" name="appointment_date" id="appointment_date" value={{ $appointment->appointment_date }} class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" required>
                        </div>
                        @error('appointment_date')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="mechanic" class="block text-sm/6 font-medium text-gray-900">Update mechanic</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="mechanic" name="mechanic" id="mechanic" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <option>{{ $appointment->mechanic }}</option>
                            </select>
                            <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="mechanic_availability" class="block text-sm/6 font-medium text-gray-900">
                            Mechanic Availability on: <span id="dateDisplay">{{ $appointment->appointment_date }}</span>
                        </label>

                        <div class="mt-2 grid grid-cols-1" id="mechanicAvailabilityList">
                            <!-- This will be populated by JavaScript -->
                            <li>John Doe [-- slot(s) left]</li>
                            <li>Jane Smith [-- slot(s) left]</li>
                            <li>Mike Brown [-- slot(s) left]</li>
                            <li>Emily Davis [-- slot(s) left]</li>
                            <li>Chris Wilson [-- slot(s) left]</li>
                        </div>
                    </div>

                    <script>
                        $('#appointment_date').change(function() {
                            const selectedDate = $(this).val();
                            $('#dateDisplay').text(selectedDate);

                            $('#mechanicAvailabilityList').html('<li>Loading availability...</li>');

                            $.get('/mechanic-availability', { selected_date: selectedDate })
                                .done(function(data) {
                                    let html_available = '';
                                    let html_mechanics = '';
                                    $.each(data.availability, function(mechanic, slots) {
                                        html_available += `<li>${mechanic} [${slots} slot(s) left]</li>`;
                                        if (slots > 0) {
                                            html_mechanics += `<option>${mechanic}</option>`;
                                        }
                                    });
                                    $('#mechanicAvailabilityList').html(html_available);
                                    $('#mechanic').html(html_mechanics);
                                })
                                .fail(function() {
                                    $('#mechanicAvailabilityList').html('<li>Error loading availability</li>');
                                });
                        });
                    </script>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div class="flex items-center">
                <button form="delete-form" class="text-red-500 text-sm font-bold">Delete</button>
            </div>
            <div class="flex items-center gap-x-6">
                <a href="/admin" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
            </div>
        </div>
    </form>

    <form method="POST" action="/appointments/{{ $appointment->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</x-layout>
