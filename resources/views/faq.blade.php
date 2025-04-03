
<x-app-layout>
    <div class="container pb-14">
        <h2 class="text-3xl mb-2">F.A.Q</h2>
        <p class="mb-4 pb-2">
            Can’t find the answer you’re looking for? We’ve shared some <br class="d-none d-md-block">
            of your most frequently asked questions to help you out!
        </p>

        <div class="w-[1000px]" x-data="accordionModules()">
            <template x-for="(acc, accIndex) in accordions" :key="accIndex">
                <div>
                    <h4 class="text-2xl mt-4 mb-4" x-text="acc.section"></h4>
                    <div class="border rounded">
                        <template x-for="(faq, faqIndex) in acc.faqs" :key="faqIndex">
                            <div class="accordion-item">
                                <div 
                                    @click="toggleFaq(accIndex, faqIndex)" 
                                    :class="faq.isOpen ? 'text-primary !font-normal' : ''" 
                                    class="border-b px-5 py-4 cursor-pointer flex justify-between w-full"
                                >
                                    <h2 x-text="faq.question"></h2>
                                    <span :class="faq.isOpen ? 'text-primary rotate-180' : ''" class="transition duration-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6l-6-6l1.41-1.41z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div x-show="faq.isOpen" x-text="faq.answer" class="accordion-body border-b px-4 py-5"></div>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('accordionModules', () => ({
                accordions: [
                    {
                        section: "Shipping Information",
                        faqs: [
                            { question: "How will my parcel be delivered?", answer: "Your parcel will be delivered via our trusted shipping partners.", isOpen: false },
                            { question: "Do I pay for delivery?", answer: "Delivery is free for orders above $50.", isOpen: false }
                        ]
                    },
                    {
                        section: "Orders and Returns",
                        faqs: [
                            { question: "Tracking my order?", answer: "You can track your order through our tracking page.", isOpen: false },
                            { question: "How do I return an item?", answer: "Returns are accepted within 30 days of purchase.", isOpen: false }
                        ]
                    }
                ],
                toggleFaq(accIndex, faqIndex) {
                    this.accordions[accIndex].faqs[faqIndex].isOpen = !this.accordions[accIndex].faqs[faqIndex].isOpen;
                }
            }));
        });
    </script>
</x-app-layout>
