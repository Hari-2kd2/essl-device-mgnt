@if ($getdeviceUser->total() == 0)
    <div class="grid grid-cols-1 text-center pt-20">
        <div class="grid place-items-center w-full">
            {{-- <img src="images/nodata.png" alt="" class="w-96 h-auto"> --}}
        </div>
        <h2 class="text-lg truncate pt-4">No such records found on database!</h2>
    </div>
@else

    @yield('table')

    <nav class="flex items-center justify-between p-4" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span
                class="font-semibold text-gray-900 dark:text-white">
                @if ($getdeviceUser->nextPageUrl() == null && $getdeviceUser->currentPage() == 1)
                    {{ $getdeviceUser->currentPage() * PER_PAGE_LIMIT - (PER_PAGE_LIMIT - 1) . ' - ' . $getdeviceUser->total() }}
                @elseif ($getdeviceUser->nextPageUrl() == null && $getdeviceUser->currentPage() != 1)
                    {{ $getdeviceUser->currentPage() * PER_PAGE_LIMIT - (PER_PAGE_LIMIT - 1) . ' - ' . $getdeviceUser->total() }}
                @else
                    {{ $getdeviceUser->currentPage() * PER_PAGE_LIMIT - (PER_PAGE_LIMIT - 1) . ' - ' . $getdeviceUser->currentPage() * PER_PAGE_LIMIT }}
                @endif

            </span>
            of <span class="font-semibold text-gray-900 dark:text-white">{{ $getdeviceUser->total() }}</span>
        </span>
        <ul class="pagination inline-flex items-center -space-x-px">
            @if ($getdeviceUser->currentPage() != 1)
                <li>
                    <a href={{ $getdeviceUser->url($getdeviceUser->currentPage() - 1) }}
                        class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-muted_hover rounded-l-lg hover:bg-muted_hover hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Previous</span>
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </li>
                @if ($getdeviceUser->currentPage() >= 3)
                    <li>
                        <a href="#"
                            class="px-3 py-2 leading-tight text-gray-500 bg-white border border-muted_hover hover:bg-muted_hover hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                    </li>
                @endif

                <li>
                    <a href={{ $getdeviceUser->url($getdeviceUser->currentPage() - 1) }}
                        class="px-3 py-2 leading-tight text-gray-500 bg-white border border-muted_hover hover:bg-muted_hover hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $getdeviceUser->currentPage() - 1 }}</a>
                </li>
            @endif
            <li>
                <a href="#" aria-current="page"
                    class="px-3 py-2 text-gray-700 border border-muted_hover bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $getdeviceUser->currentPage() }}</a>
            </li>
            @if ($getdeviceUser->nextPageUrl() != null)
                <li>
                    <a href={{ $getdeviceUser->url($getdeviceUser->currentPage() + 1) }}
                        class="px-3 py-2 leading-tight text-gray-500 bg-white border border-muted_hover hover:bg-muted_hover hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $getdeviceUser->currentPage() + 1 }}</a>
                </li>
                <li>
                    <a href="#"
                        class="px-3 py-2 leading-tight text-gray-500 bg-white border border-muted_hover hover:bg-muted_hover hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                </li>
                <li>
                    <a href={{ $getdeviceUser->url($getdeviceUser->currentPage() + 1) }}
                        class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-muted_hover rounded-r-lg hover:bg-muted_hover hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="sr-only">Next</span>
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd">
                            </path>
                        </svg>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>
@endif