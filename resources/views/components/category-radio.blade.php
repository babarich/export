@props(['categoryList'])


    @if (!empty($categoryList))
        <div>
           <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">All Categories</h3>
        </div>
        @foreach($categoryList as $category)
        
        <label class="category-item relative flex items-center pl-6 border-b
         border-[#C8C8CE] pr-4 py-3 w-full text-primary transition duration-300 hover:bg-[#EFEFEF] cursor-pointer">
            <input type="radio" name="category" value="{{ $category->id }}" class="hidden category-radio">
            <span class="text-[15px]">{{ $category->name }}</span>
        </label>
     
        @endforeach

        
   
    @endif








