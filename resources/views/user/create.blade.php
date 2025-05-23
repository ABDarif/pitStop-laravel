<x-layout>
    <x-slot:heading>
        Book an appointment!
    </x-slot:heading>
    <x-slot:nav>
        <x-nav-link href="/" :active="request()->is('/')">User</x-nav-link>
        <x-nav-link href="/admin" :active="request()->is('admin')">Admin</x-nav-link>
        <x-nav-link href="/mechanic" :active="request()->is('mechanic')">Mechanic</x-nav-link>
    </x-slot:nav>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <form method="POST" action="/appointments">
        @csrf
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
            <p class="mt-1 text-sm/6 text-gray-600">Please insert necessary contact informations</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-3">
                <x-form-label for='first_name'>First Name</x-form-label>
                <x-form-input name='first_name' id='first_name' :value="old('first_name')" required/>
                <x-form-error name='first_name' />
              </div>

              <div class="sm:col-span-3">
                <x-form-label for='last_name'>Last Name</x-form-label>
                <x-form-input name='last_name' id='last_name' :value="old('last_name')" required/>
                <x-form-error name='last_name' />
              </div>

              <div class="sm:col-span-3">
                <x-form-label for='email'>Email</x-form-label>
                <x-form-input name='email' id='email' :value="old('email')" required/>
                <x-form-error name='email' />
              </div>

              <div class="sm:col-span-3">
                <x-form-label for='phone'>Phone</x-form-label>
                <x-form-input name='phone' id='phone' :value="old('phone')" required/>
                <x-form-error name='phone' />
              </div>

              <div class="col-span-full">
                <x-form-label for='address'>Address</x-form-label>
                <x-form-input name='address' id='address' :value="old('address')" required/>
                <x-form-error name='address' />
              </div>
            </div>
          </div>
        </div>

        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base/7 font-semibold text-gray-900">Vehicle Information</h2>
            <p class="mt-1 text-sm/6 text-gray-600">Please insert your vehicle information</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-3">
                <x-form-label for='car_license'>License No.</x-form-label>
                <x-form-input name='car_license' id='car_license' :value="old('car_license')" required/>
                <x-form-error name='car_license' />
              </div>

              <div class="sm:col-span-3">
                <x-form-label for='car_engine'>Engine No.</x-form-label>
                <x-form-input name='car_engine' id='car_engine' :value="old('car_engine')" required/>
                <x-form-error name='car_engine' />
              </div>
            </div>
          </div>
        </div>

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Appointment & Mechanic Information</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Select your preferred appointment date & mechanic</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2">
                        <label for="appointment_date" class="block text-sm/6 font-medium text-gray-900">Select appointment date</label>
                        <div class="mt-2 grid grid-cols-1">
                            <input type="date" name="appointment_date" id="appointment_date" :value="old('appointment_date')" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" required>
                        </div>
                        @error('appointment_date')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="mechanic" class="block text-sm/6 font-medium text-gray-900">Select mechanic</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="mechanic" name="mechanic" id="mechanic" :value="old('mechanic')" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <option>--</option>
                            </select>
                            <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="mechanic_availability" class="block text-sm/6 font-medium text-gray-900">
                            Mechanic Availability on: <span id="dateDisplay">Select a date</span>
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

        <div class="mt-6 flex items-center justify-end gap-x-6">
          <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
          <x-form-button>Save</x-form-button>
        </div>
      </form>


</x-layout>
