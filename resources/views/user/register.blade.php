<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-links />
    <title>MyGrocery | Register</title>
</head>
<body>
    <x-card>
        {{-- Login container --}}
        <div class="bg-lime-100 flex rounded-2xl shadow-lg max-w-4xl p-5">
            {{-- form --}}
            <div class="sm:w-1/2 px-16 mt-5 mb-5">
                <div class="relative">
                    <img style="width: 50px" class="absolute top-1/2 -translate-y-1/2" src="/images/logo-preview.png" alt="">
                    <h2 class="font-bold text-2xl text-slate-800 ml-12">Register</h2>
                </div>
                <p class="text-sm mt-4">Fill this form to claim the word "My"</p>
            
                <form method="POST" action="{{ route('user.new') }}" class="flex flex-col gap-4">
                    @csrf
                    <div>
                        {{-- Firstname --}}
                        <input class="w-full border border-gray-400 p-2 rounded-xl border mt-8" type="text" name="fname" placeholder="First Name" value="{{ old('fname') }}">
                        @error('fname')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        {{-- Middle name --}}
                        <input class="w-full border border-gray-400 p-2 rounded-xl border" type="text" name="mname" placeholder="Middle Name" value="{{ old('mname') }}">
                        @error('mname')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    {{-- Last name --}}
                    <div>
                        <input class="w-full border border-gray-400 p-2 rounded-xl border" type="text" name="lname" placeholder="Lastname Name" value="{{ old('lname') }}">
                        @error('lname')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="">
                        {{-- Email --}}
                        <input class="w-full border border-gray-400 p-2 rounded-xl border" type="email" name="email" placeholder="Valid Email" value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    {{-- Password --}}
                    <div class="">
                        <div class="relative">
                            <input type="password" name="password" placeholder="Password" class="border border-gray-400 p-2 rounded-xl border w-full">
                            <svg onclick="" xmlns="//www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-eye absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="">
                        <div class="relative">
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="border border-gray-400 p-2 rounded-xl border w-full">
                            <svg xmlns="//www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-shield-lock absolute top-1/2 right-3 -translate-y-1/2" viewBox="0 0 16 16">
                                <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
                                <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z"/>
                            </svg>
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-slate-800 hover:bg-lime-600 duration-500 rounded-xl text-white py-2">Register</button>
                </form>

                <div class="text-sm mt-3 border-b border-gray-400 pb-5 flex justify-between items-center">
                    <p>Already have an account?</p>
                    <a href="/login" class="py-2 px-5 bg-slate-800 hover:bg-lime-600 duration-500 text-white border border-slate-800 rounded-xl">Login</a>
                </div>
                <a href="/">
                    <p class="mt-5 text-xs hover:text-lime-900"><ion-icon name="arrow-back-outline"></ion-icon> Go back to home page.</p>
                </a>
            </div>
            {{-- image --}}
            <div class="sm:block hidden w-1/2 p-5 rounded-2xl items-center justify-center">
                <img class="mt-20" src="{{ asset('images/undraw_join_re_w1lh.svg') }}" alt="">
            </div>
        </div>
    </x-card>
</body>
</html>