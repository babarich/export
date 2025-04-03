@props(['categoryList'])

<div x-data="{ open: false }" {{ $attributes->merge(['class' => 'category-list flex text-white bg-primary']) }}>
    @if (!empty($categoryList))
    <div class="bg-secondary py-1.5 w-[210px] relative hidden lg:block mr-8">
        <!-- Clickable header -->
        <div @click="open = !open" class="py-2.5 px-4 flex items-center justify-center w-full cursor-pointer">
            <span class="text-white mr-2.5">
                <svg width="20" height="20" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </span>
            <span class="text-white text-base">All categories</span>
        </div>
        
        <!-- Dropdown menu -->
        <div x-show="open" @click.outside="open = false" x-transition
            class="absolute top-full left-0 w-full py-4 bg-white shadow-md z-10">
            @foreach($categoryList as $category)
            <div class="category-item relative">
                <a href="{{ route('byCategory', $category) }}"
                    class="flex items-center pl-6 border-b border-[#C8C8CE] pr-4 py-3 w-full text-primary transition duration-300 hover:bg-[#EFEFEF]">
                    <span class="text-[15px] cursor-pointer text-primary"> {{ $category->name }}</span>
                </a>
                <!-- If category has children, display nested dropdown -->
                @if(!empty($category->children))
                    <x-category-list class="absolute left-0 top-[100%] z-50 hidden flex-col"
                     :category-list="$category->children"/>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif


          <ul class="flex items-center">
                    <!-- home -->
                    <li class="relative group">
                        <a href="{{ route('home') }}"
                            class="text-white leading-[26px] flex items-center text-base font-medium px-2.5 py-[15px] gap-1 transition duration-300">Home
                            
                        </a>

                        
                    </li>
                    <!-- shop -->
                    <li class="relative group">
                        <a href="#"
                            class="text-white leading-[26px] flex items-center text-base font-medium px-2.5 py-[15px] gap-1 transition duration-300">Shop
                          
                        </a>

                        
                    </li>
                    
                    <!-- contact -->
                    <li><a href="{{route('page.contact')}}"
                            class="text-white leading-[26px] flex items-center text-base font-medium px-2.5 py-[15px] transition duration-300">Contact</a>
                    </li>
                </ul>


</div>
