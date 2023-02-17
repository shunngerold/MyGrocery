<nav class="z-10 w-full flex flex-wrap items-center justify-between py-3 bg-lime-200 shadow-lg navbar navbar-expand-lg navbar-light fixed top-0 right-0 left-0">
    <div class="container-fluid w-full flex flex-wrap items-center md:justify-between justify-center px-6">
        <div class="flex justify-start items-center">
            <button
                class="navbar-toggler text-gray-200 border-0 hover:shadow-none hover:no-underline py-2 px-2.5 bg-transparent focus:outline-none focus:ring-0 focus:shadow-none focus:no-underline"
                type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars" class="w-6"
                    role="img" xmlns="//www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path fill="black"
                        d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z">
                    </path>
                </svg>
            </button>
            {{-- Logo --}}
            <a class="text-xl pr-2 font-semibold" href="#">
                <div class="relative justify-start">
                    <img src="{{ asset('images/logo-preview.png') }}" alt="Logo"
                        class="h-14 w-14 ml-1 absolute top-1/2 -translate-y-1/2">
                    <div class="ml-16 justify-center items-center">
                        <h2 class="text-3xl font-bold"><span class="text-lime-500">My</span>Grocery</h2>
                        <p class="text-sm text-lime-900">Our service is yours!</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="collapse mt-6 md:mt-0 navbar-collapse flex-grow items-center" id="navbarSupportedContent1"> 
            <!-- Left links -->
            <ul class="navbar-nav text-stone-900 flex flex-col pl-4 list-style-none mr-auto">
                <li class="nav-item p-2 hover:text-lime-800 hover:underline flex justify-center">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item p-2">
                    <a class="dropdown-toggl flex items-center whitespace-nowrap" href="#" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <p>Products</p>
                        <svg aria-hidden="true" focusable="false"  data-prefix="fas" data-icon="caret-down" class="w-2 ml-2" role="img" xmlns="//www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path fill="currentColor" d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                        </svg>
                    </a>
                    <ul class="dropdown-menu min-w-max absolute hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg -lg mt-1 hidden m-0 bg-clip-padding border-none" aria-labelledby="dropdownMenuButton2">
                        <li>
                            <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" href="{{ route('user.products') }}">All Products</a>
                        </li>
                        <li>
                            <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" href="{{ route('user.products') }}">Canned Goods</a>
                        </li>
                        <li>
                            <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" href="{{ route('user.products') }}">Breads and Sweets</a>
                        </li>
                        <li>
                            <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" href="{{ route('user.products') }}">Snacks</a>
                        </li>
                        <li>
                            <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" href="{{ route('user.products') }}">Meats and Poultry</a>
                        </li>
                        <li>
                            <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" href="{{ route('user.products') }}">Fruits and Veggies</a>
                        </li>
                        <li>
                            <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" href="{{ route('user.products') }}">Instant Goods</a>
                        </li>
                        <li>
                            <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" href="{{ route('user.products') }}">Beverages</a>
                        </li>
                        <li>
                            <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" href="{{ route('user.products') }}">Others</a>
                        </li>
                    </ul> 
                </li>
                <li class="nav-item p-2">
                    <a class="nav-link hover:text-lime-800 hover:underline p-0 flex justify-center" href="#">
                        About Us
                    </a>
                </li>
                <li class="nav-item p-2">
                    <a class="nav-link hover:text-lime-800 hover:underline p-0 flex justify-center" href="{{ route('admin.manage') }}">
                        MyDeals
                    </a>
                </li>
                <li class="nav-item p-2">
                    <a class="nav-link hover:text-lime-800 hover:underline p-0 flex justify-center" href="#">
                        Contact Us
                    </a>
                </li>
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <div class="flex mt-2 md:mt-0 ml-4 md:ml-0 mb-2 md:mb-0 items-center justify-center">
            {{-- Search --}}
            <button type="button" class="text-white mr-4 text-black hover:text-lime-800" data-bs-toggle="modal" data-bs-target="#searchModal">
                <svg xmlns="//www.w3.org/2000/svg" fill="currentColor" class="bi bi-search w-[23px] h-[23px]"
                    viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button>
            {{-- Cart --}}
            <a class="text-white mr-4 text-black hover:text-lime-800" href="#">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="shopping-cart"
                    class="w-[23px] h-[23px]" role="img" xmlns=//www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path fill="currentColor"
                        d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z">
                    </path>
                </svg>
            </a>
            {{-- Notification --}}
            <div class="dropdown relative mr-2">
                <a class="text-white text-black hover:text-lime-800 mr-4 dropdown-toggle hidden-arrow flex items-center"
                    href="#" id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="My Notification">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell"
                        class="w-[23px] h-[23px]" role="img" xmlns="//www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z">
                        </path>
                    </svg>
                    <span class="text-white bg-red-700 absolute rounded-full text-xs -mt-2.5 ml-2 py-0 px-1.5">2</span>
                </a>
                <ul
                    class="dropdown-menu min-w-max absolute hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none left-auto right-0">
                    <li>
                        <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                            href="#">Action</a>
                    </li>
                    <li>
                        <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                            href="#">Another action</a>
                    </li>
                    <li>
                        <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                            href="#">Something else here</a>
                    </li>
                </ul>
            </div>
            @auth
                {{-- Profile --}}
                <div class="dropdown relative">
                    <a class="dropdown-toggle flex items-center hidden-arrow transition duration-500 ease-in-out"
                        href="#" id="dropdownMenuButton2" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="My Profile">
                        <img src="//mdbootstrap.com/img/new/avatars/2.jpg" class="rounded-full"
                            style="height: 40px; width: 40px" alt="" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu min-w-max absolute hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none left-auto right-0"
                        aria-labelledby="dropdownMenuButton2">
                        <li>
                            <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                href="#">Action</a>
                        </li>
                        <li>
                            <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100"
                                href="#">Another action</a>
                        </li>
                        <li>
                            <button type="button" class="flex justify-start dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                Logout
                            </button>
                        </li>
                    </ul>
                </div>
            @else
                {{-- Login --}}
                <a href="{{ route('user.login') }}" class="bg-[#239807] text-white duration-500 px-4 py-2 hover:bg-green-800 rounded-xl relative border border-stone-400">
                    <svg xmlns="//www.w3.org/2000/svg" width="17" height="17" fill="currentColor"
                        class="bi bi-box-arrow-in-right absolute top-1/2 -translate-y-1/2" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                        <path fill-rule="evenodd"
                            d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                    </svg>
                    <p class="ml-8 text-sm font-[Poppins]">Login</p>
                    
                </a>
            @endauth
        </div>
        <!-- Right elements -->
    </div>
</nav>

<!-- Search Modal -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="searchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none">
        <div
            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div
                class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                    <div class="flex justify-start items-center">
                        <img src="images/logo-preview.png" class="h-12 mr-3" alt="MyGrocery Logo" />
                        <p>Search</p>
                    </div>
                </h5>
                <button type="button" class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close">
                    {{-- Empty --}}
                </button>
            </div>
            <div class="modal-body relative p-4">
                <form action="/products" id="search-form" method="GET">
                    <input type="text" name="search" class="form-control block w-full px-3 py-1.5 text-base font-normal text-slate-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleFormControlInput1" placeholder="What are you looking for?" />
                </form>
            </div>
            <div
                class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                <button type="button"
                    class="inline-block px-6 py-2.5 bg-yellow-400 text-slate-700 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-600 hover:shadow-lg hover:text-white focus:yellow-200 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-200 active:shadow-lg transition duration-300 ease-in-out"
                    data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" form="search-form"
                    class="inline-block px-6 py-2.5 bg-[#239807] text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-lime-800 hover:shadow-lg focus:bg-lime-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-lime-500 active:shadow-lg transition duration-300 ease-in-out ml-1">
                    Search
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none">
        <div
            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div
                class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                    <div class="flex justify-start items-center">
                        <img src="images/logo-preview.png" class="h-12 mr-3" alt="MyGrocery Logo" />
                        <p>Logout</p>
                    </div>
                </h5>
                <button type="button" class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close">
                    {{-- Empty --}}
                </button>
            </div>
            <div class="modal-body relative p-4">
                <p>Are you sure you want to logout?</p>
            </div>
            <div
                class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                <button type="button" class="inline-block px-6 py-2.5 bg-yellow-400 text-slate-700 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-600 hover:shadow-lg hover:text-white focus:yellow-200 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-200 active:shadow-lg transition duration-300 ease-in-out" data-bs-dismiss="modal">
                    Close
                </button>
                <form action="{{ route('user.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="inline-block px-6 py-2.5 bg-[#239807] text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-lime-800 hover:shadow-lg focus:bg-lime-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-lime-500 active:shadow-lg transition duration-300 ease-in-out ml-1">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

