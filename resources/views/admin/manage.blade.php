<!DOCTYPE html>
<html lang="en">
    <head>
        <x-head-links/>
        <title>MyGrocery | Admin</title>
    </head>
    <body>
        <x-sidenav/>
        <div class="flex flex-col ml-[14rem]">
            <div >
                <div class="inline-block min-w-full">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-center">
                            <thead class="border-b bg-[#239807]">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                        First
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                        Last
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                        Handle
                                    </th>
                                </tr>
                            </thead class="border-b">
                            <tbody>
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        Mark
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        Otto
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        @mdo
                                    </td>
                                </tr class="bg-white border-b">
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        Jacob
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        Thornton
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        @fat
                                    </td>
                                </tr>
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">3</td>
                                    <td colspan="2"
                                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                        Larry the Bird
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        @twitter
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <x-foot-links/>
    </body>
</html>