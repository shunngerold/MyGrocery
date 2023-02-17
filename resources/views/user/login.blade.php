<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-links />
    <title>MyGrocery | Login</title>
</head>
<body >
    <x-card>
        {{-- Login container --}}
        <div class="bg-lime-100 flex rounded-2xl shadow-lg max-w-4xl p-5">
            {{-- form --}}
            <div class="lg:w-1/2 px-16 mt-5 mb-5">
                <div class="relative">
                    <img style="width: 50px" class="absolute top-1/2 -translate-y-1/2" src="/images/logo-preview.png" alt="">
                    <h2 class="font-bold text-2xl text-slate-800 ml-12">Login</h2>
                </div>
                <p class="text-sm mt-4">If you already a member, easily log in</p>
            
                <form method="POST" action="{{ route('user.auth') }}" class="flex flex-col gap-4">
                    @csrf
                    <div>
                        <input type="email" name="email" placeholder="Email" class="w-full border-gray-400 p-2 rounded-xl border mt-8" value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="">
                        <div class="relative">
                            <input type="password" name="password" placeholder="Password" class="border-gray-400 p-2 rounded-xl border w-full">
                            <svg xmlns="//www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-eye absolute top-1/2 right-3 -translate-y-1/2" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                   
                    <div class="flex w-full justify-center items-center">
                        <p class="text-sm">Forgot your password?</p>
                    </div>
                    <button type="submit" class="bg-slate-800 hover:bg-lime-600 duration-500 rounded-xl text-white py-2">Login</button>
                </form>

                <div class="mt-6 grid grid-cols-3 items-center text-gray-400">
                    <hr class="border-gray-500">
                    <p class="text-center text-sm">OR</p>
                    <hr class="border-gray-500">
                </div>

                <button class="bg-white border border-gray-400 py-2 w-full rounded-xl mt-5 flex justify-center text-sm">
                    <svg class="mr-3" height="25px" width="25px" xmlns="//www.w3.org/2000/svg" xmlns:xlink="//www.w3.org/1999/xlink" viewBox="0 0 48 48"><defs><path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/></svg>
                    Login with Google
                </button>
            
                <div class="text-sm mt-3 flex justify-between border-b border-gray-400 items-center pb-4">
                    <p>Don't have an account?</p>
                    <a href="{{ route('user.register') }}" class="py-2 px-5 bg-slate-800 text-white border border-gray-500 hover:bg-lime-600 duration-500 rounded-xl">Register</a>
                </div>
                <a href="/">
                    <p class="mt-5 text-xs hover:text-lime-900"><ion-icon name="arrow-back-outline"></ion-icon> Go back to home page.</p>
                </a>
            </div>
            {{-- image --}}
            <div class="lg:block hidden w-1/2 p-5 rounded-2xl">
                <img class="mt-12 w-auto h-auto" src="{{ asset('images/undraw_access_account_re_8spm.svg') }}" alt="">
            </div>
        </div>
    </x-card>
</body>
</html>