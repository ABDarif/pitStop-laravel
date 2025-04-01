<x-layout>
    <x-slot:heading>
        User Create Page
    </x-slot:heading>
    <x-slot:nav>
        <x-nav-link href="/" :active="request()->is('/')">User_create</x-nav-link>
        <x-nav-link href="/index" :active="request()->is('/index')">User_index</x-nav-link>
    </x-slot:nav>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

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

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-2">
                        <label for="appointment_date" class="block text-sm/6 font-medium text-gray-900">Update appointment date</label>
                        <div class="mt-2 grid grid-cols-1">
                            <input type="date" name="appointment_date" id="appointment_date" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="XX-XX-XXXX" required>
                        </div>
                        @error('appointment_date')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="mechanic" class="block text-sm/6 font-medium text-gray-900">Update mechanic</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="mechanic" name="mechanic" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <option>John Doe</option>
                                <option>Jane Smith</option>
                                <option>Mike Brown</option>
                                <option>Emily Davis</option>
                                <option>Chris Wilson</option>
                            </select>
                            <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="mechanic_availability" class="block text-sm/6 font-medium text-gray-900">Mechanic Availability on the selected date</label>
                        <div class="mt-2 grid grid-cols-1">
                            <li>John Doe [{{ 4-$count_M1 }} slot(s) left]</li>
                            <li>Jane Smith [{{ 4-$count_M2 }} slot(s) left]</li>
                            <li>Mike Brown [{{ 4-$count_M3 }} slot(s) left]</li>
                            <li>Emily Davis [{{ 4-$count_M4 }} slot(s) left]</li>
                            <li>Chris Wilson [{{ 4-$count_M5 }} slot(s) left]</li>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
          <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
          <x-form-button>Save</x-form-button>
        </div>
      </form>


</x-layout>
