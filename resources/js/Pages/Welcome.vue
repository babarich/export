<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue'


defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    
    <GuestLayout>


 <nav class="relative w-full top-0 mx-auto p-4 sm:fixed sm:right-0  mb-6 bg-white shadow-sm">
      <!-- Flex container -->
      <div class="flex items-center justify-between">
        <!-- Logo -->
        <div class="pt-2 text-primary px-6">
         <a href="index.html">
                <img src="assets/images/logo.svg" alt="Logo" class="w-32">
            </a>
        </div>
        <!-- Menu Items -->
        <div class="hidden space-x-6 md:flex">
            <div class="px-8 md:flex items-center cursor-pointer relative group hidden">
               
                <span class="capitalize ml-2">All Categories <i class="fa-solid fa-caret-down"></i></span>

                <!-- dropdown -->
                <div
                    class="absolute w-full left-0 top-full bg-white shadow-md py-3 divide-y divide-gray-300 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
                    <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <img src="assets/images/icons/sofa.svg" alt="sofa" class="w-5 h-5 object-contain">
                        <span class="ml-6 text-gray-600 text-sm">Sofa</span>
                    </a>
                    <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <img src="assets/images/icons/terrace.svg" alt="terrace" class="w-5 h-5 object-contain">
                        <span class="ml-6 text-gray-600 text-sm">Terarce</span>
                    </a>
                    <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <img src="assets/images/icons/bed.svg" alt="bed" class="w-5 h-5 object-contain">
                        <span class="ml-6 text-gray-600 text-sm">Bed</span>
                    </a>
                    <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <img src="assets/images/icons/office.svg" alt="office" class="w-5 h-5 object-contain">
                        <span class="ml-6 text-gray-600 text-sm">office</span>
                    </a>
                    <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <img src="assets/images/icons/outdoor-cafe.svg" alt="outdoor" class="w-5 h-5 object-contain">
                        <span class="ml-6 text-gray-600 text-sm">Outdoor</span>
                    </a>
                    <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <img src="assets/images/icons/bed-2.svg" alt="Mattress" class="w-5 h-5 object-contain">
                        <span class="ml-6 text-gray-600 text-sm">Mattress</span>
                    </a>
                </div>
            </div>
          <a href="#" class="hover:text-darkGrayishBlue">Pricing</a>
          <a href="#" class="hover:text-darkGrayishBlue">Product</a>
          <a href="#" class="hover:text-darkGrayishBlue">About Us</a>
          <a href="#" class="hover:text-darkGrayishBlue">Careers</a>
        </div>
        <!-- Button -->
          <div v-if="canLogin" class="flex justify-between">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
             class="hidden font-semibold p-3 px-6 pt-2 md:block">Dashboard</Link>

            <template  v-else>
                <Link :href="route('login')" class="hidden font-semibold p-3 px-6 pt-2 md:block">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" 
                       class="hidden p-3 px-6 pt-2 text-white bg-primary rounded-full baseline hover:bg-primary md:block">Get Started</Link>
            </template>
        </div>
      

        <!-- Hamburger Icon -->
        <button
          id="menu-btn"
          class="block hamburger md:hidden focus:outline-none"
        >
          <span class="hamburger-top"></span>
          <span class="hamburger-middle"></span>
          <span class="hamburger-bottom"></span>
        </button>
      </div>

      <!-- Mobile Menu -->
      <div class="md:hidden">
        <div
          id="menu"
          class="absolute flex-col items-center hidden self-end py-8 mt-10 space-y-6
           font-bold bg-white sm:w-auto sm:self-center left-6 right-6 drop-shadow-md"
        >
          <a href="#">Pricing</a>
          <a href="#">Product</a>
          <a href="#">About Us</a>
          <a href="#">Careers</a>
        </div>
      </div>
    </nav>

    

    <!-- Hero Section -->
    <section id="hero" class="mt-10 py-10">
      <!-- Flex Container -->
      <div
        class="container flex flex-col-reverse items-center px-6 mx-auto mt-10 space-y-0 md:space-y-0 md:flex-row"
      >
        <!-- Left item -->
        <div class="flex flex-col mb-32 space-y-12 md:w-1/2">
          <h1
            class="max-w-md text-4xl font-bold text-center md:text-5xl md:text-left"
          >
            Bring everyone together to build better products
          </h1>
          <p class="max-w-sm text-center text-darkGrayishBlue md:text-left">
            Maduka System makes it simple for software teams to plan day-to-day tasks
            while keeping the larger team goals in view.
          </p>
          <div class="flex justify-center md:justify-start">
           <Link v-if="canRegister" :href="route('register')" 
                       class="p-3 px-6 pt-2 text-white bg-primary rounded-full baseline hover:bg-primary md:block">Get Started</Link>
          </div>
        </div>
        <!-- Image -->
        <div class="md:w-1/2">
          <img src="img/illustration-intro.svg" alt="" />
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section id="features">
      <!-- Flex container -->
      <div
        class="container flex flex-col px-4 mx-auto mt-10 space-y-12 md:space-y-0 md:flex-row"
      >
        <!-- What's Different -->
        <div class="flex flex-col space-y-12 md:w-1/2">
          <h2 class="max-w-md text-4xl font-bold text-center md:text-left">
            What's different about Maduka System?
          </h2>
          <p class="max-w-sm text-center text-darkGrayishBlue md:text-left">
            Never worry about running out of stock or overstocking again. 
            A sophisticated  System allows you to manage your inventory effortlessly.
            Keep track of stock levels, receive alerts for low quantities, and even automate reordering. 
            This means you can optimize your inventory and allocate resources more effectively.Track Your expenses, 
            generate more revenue and even better get ahead of your business
          </p>
        </div>

        <!-- Numbered List -->
        <div class="flex flex-col space-y-8 md:w-1/2">
          <!-- List Item 1 -->
          <div
            class="flex flex-col space-y-3 md:space-y-0 md:space-x-6 md:flex-row"
          >
            <!-- Heading -->
            <div class="rounded-l-full bg-brightRedSupLight md:bg-transparent">
              <div class="flex items-center space-x-2">
                <div
                  class="px-4 py-2 text-white rounded-full md:py-1 bg-primary"
                >
                  01
                </div>
                <h3 class="text-base font-bold md:mb-4 md:hidden">
                  Multi-Location Management
                </h3>
              </div>
            </div>

            <div>
              <h3 class="hidden mb-4 text-lg font-bold md:block">
                Multi-Location Management
              </h3>
              <p class="text-darkGrayishBlue">
                Scaling your business is a breeze with a Maduka System that supports multi-location management. Whether you have one store or a chain of locations, you can oversee operations, track inventory, and analyze sales data across all outlets from a central dashboard.
              </p>
            </div>
          </div>

          <!-- List Item 2 -->
          <div
            class="flex flex-col space-y-3 md:space-y-0 md:space-x-6 md:flex-row"
          >
            <!-- Heading -->
            <div class="rounded-l-full bg-brightRedSupLight md:bg-transparent">
              <div class="flex items-center space-x-2">
                <div
                  class="px-4 py-2 text-white rounded-full md:py-1 bg-primary"
                >
                  02
                </div>
                <h3 class="text-base font-bold md:mb-4 md:hidden">
                  Accurate Sales Reporting:
                </h3>
              </div>
            </div>

            <div>
              <h3 class="hidden mb-4 text-lg font-bold md:block">
                Accurate Sales Reporting:
              </h3>
              <p class="text-darkGrayishBlue">
                Gain valuable insights into your business performance with accurate and real-time sales reporting.
                 Maduka System provides you with comprehensive sales data, helping you identify top-performing products,
                  track trends, and make informed decisions to drive growth.
              </p>
            </div>
          </div>

          <!-- List Item 3 -->
          <div
            class="flex flex-col space-y-3 md:space-y-0 md:space-x-6 md:flex-row"
          >
            <!-- Heading -->
            <div class="rounded-l-full bg-brightRedSupLight md:bg-transparent">
              <div class="flex items-center space-x-2">
                <div
                  class="px-4 py-2 text-white rounded-full md:py-1 bg-primary"
                >
                  03
                </div>
                <h3 class="text-base font-bold md:mb-4 md:hidden">
                  Time and Cost Savings
                </h3>
              </div>
            </div>

            <div>
              <h3 class="hidden mb-4 text-lg font-bold md:block">
                Time and Cost Savings
              </h3>
              <p class="text-darkGrayishBlue">
                Automating various tasks through a POS system translates to significant time and cost savings. 
                With streamlined processes, your staff can focus on more value-added activities, boosting productivity and reducing operational costs.
                In a world where customer expectations are higher than ever, a modern POS system can be the game-changer your business needs. 
                From enhancing customer experiences to improving operational efficiency, 
                the benefits of a POS system are undeniable. Don't just meet customer demands – exceed 
                them with a cutting-edge POS solution that empowers your business to thrive in the digital age
              </p>
            </div>
          </div>


            <div
            class="flex flex-col space-y-3 md:space-y-0 md:space-x-6 md:flex-row"
          >
            <!-- Heading -->
            <div class="rounded-l-full bg-brightRedSupLight md:bg-transparent">
              <div class="flex items-center space-x-2">
                <div
                  class="px-4 py-2 text-white rounded-full md:py-1 bg-primary"
                >
                  04
                </div>
                <h3 class="text-base font-bold md:mb-4 md:hidden">
                  Enhanced Customer Relationships:
                </h3>
              </div>
            </div>

            <div>
              <h3 class="hidden mb-4 text-lg font-bold md:block">
                Enhanced Customer Relationships:
              </h3>
              <p class="text-darkGrayishBlue">
                Delight your customers with personalized experiences.
                 Maduka System  allows you to create and manage customer profiles, enabling you to offer tailored promotions, loyalty rewards, and targeted marketing campaigns. Building strong customer relationships can lead to increased loyalty and repeat business
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials">
      <!-- Container to heading and testm blocks -->
      <div class="max-w-6xl px-5 mx-auto mt-32 text-center">
        <!-- Heading -->
        <h2 class="text-4xl font-bold text-center">
          What's Different About Maduka System?
        </h2>
        <!-- Testimonials Container -->
        <div class="flex flex-col mt-24 md:flex-row md:space-x-6">
          <!-- Testimonial 1 -->
          <div
            class="flex flex-col items-center p-6 space-y-6 rounded-lg bg-veryLightGray md:w-1/3"
          >
            <img src="img/avatar-anisha.png" class="w-16 -mt-14" alt="" />
            <h5 class="text-lg font-bold">Anisha Li</h5>
            <p class="text-sm text-darkGrayishBlue">
              “Maduka System has supercharged our team’s workflow. The ability to
              maintain visibility on larger milestones at all times keeps
              everyone motivated.”
            </p>
          </div>

          <!-- Testimonial 2 -->
          <div
            class="hidden flex-col items-center p-6 space-y-6 rounded-lg bg-veryLightGray md:flex md:w-1/3"
          >
            <img src="img/avatar-ali.png" class="w-16 -mt-14" alt="" />
            <h5 class="text-lg font-bold">Ali Bravo</h5>
            <p class="text-sm text-darkGrayishBlue">
              “We have been able to cancel so many other subscriptions since
              using Maduka System. There is no more cross-channel confusion and
              everyone is much more focused.”
            </p>
          </div>

          <!-- Testimonial 3 -->
          <div
            class="hidden flex-col items-center p-6 space-y-6 rounded-lg bg-veryLightGray md:flex md:w-1/3"
          >
            <img src="img/avatar-richard.png" class="w-16 -mt-14" alt="" />
            <h5 class="text-lg font-bold">Richard Watts</h5>
            <p class="text-sm text-darkGrayishBlue">
              “Maduka System has supercharged our team’s workflow. The ability to
              maintain visibility on larger milestones at all times keeps
              everyone motivated.”
            </p>
          </div>
        </div>
        <!-- Button -->
        <div class="my-16">
          <a
            href="#"
            class="p-3 px-6 pt-2 text-white bg-primary rounded-full baseline hover:bg-brightRedLight"
            >Get Started</a
          >
        </div>
      </div>
    </section>


    <!-- Footer -->
    <footer class="bg-veryDarkBlue">
      <!-- Flex Container -->
      <div
        class="container flex flex-col-reverse justify-between px-6 py-10 mx-auto space-y-8 md:flex-row md:space-y-0"
      >
        <!-- Logo and social links container -->
        <div
          class="flex flex-col-reverse items-center justify-between space-y-12 md:flex-col md:space-y-0 md:items-start"
        >
          <div class="mx-auto my-6 text-center text-white md:hidden">
            Copyright &copy; {{ new Date().getFullYear() }}, All Rights Reserved
          </div>
          <!-- Logo -->
          <div>
           <h3 class="font-bold text-2xl leading-tight text-white hover:text-primary">Maduka System</h3> 
          </div>

        </div>
        <!-- List Container -->
        <div class="flex justify-around space-x-32">
          <div class="flex flex-col space-y-3 text-white">
            <a href="#" class="hover:text-primary">Home</a>
            <a href="#" class="hover:text-primary">Pricing</a>
            <a href="#" class="hover:text-primary">Products</a>
            <a href="#" class="hover:text-primary">About</a>
          </div>
          <div class="flex flex-col space-y-3 text-white">
            <a href="#" class="hover:text-primary">Careers</a>
            <a href="#" class="hover:text-primary">Privacy Policy</a>
          </div>
        </div>

        <!-- Input Container -->
        <div class="flex flex-col justify-between">
          <form>
            <div class="flex space-x-3">
              <input
                type="text"
                class="flex-1 px-4 rounded-full focus:outline-none"
                placeholder="Updated in your inbox"
              />
              <button
                class="px-6 py-2 text-white rounded-full bg-primary hover:bg-primary focus:outline-none"
              >
                Go
              </button>
            </div>
          </form>
          <div class="hidden text-white md:block">
            Copyright &copy; {{ new Date().getFullYear() }}, All Rights Reserved
          </div>
        </div>
      </div>
    </footer> 

     </GuestLayout>
</template>
<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>