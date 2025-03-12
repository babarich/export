import { ref } from "vue";
import { router } from "@inertiajs/vue3";

export function useDashboard() {
  const loading = ref({
    customersCount: true,
    productsCount: true,
    paidOrders: true,
    totalIncome: true,
    ordersByCountry: true,
    latestCustomers: true,
    latestOrders: true,
  });

  const customersCount = ref(0);
  const productsCount = ref(0);
  const paidOrders = ref(0);
  const totalIncome = ref(0);
  const ordersByCountry = ref([]);
  const latestCustomers = ref([]);
  const latestOrders = ref([]);

  const dateOptions = [
    { key: "1d", text: "Last Day" },
    { key: "1w", text: "Last Week" },
    { key: "2w", text: "Last 2 Weeks" },
    { key: "1m", text: "Last Month" },
    { key: "3m", text: "Last 3 Months" },
    { key: "6m", text: "Last 6 Months" },
    { key: "all", text: "All Time" },
  ];
  const chosenDate = ref("all");

  let debounceTimeout;
  const fetchDashboardData = async (date) => {
    if (debounceTimeout) clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(async () => {
      try {
        // Reset loading states
        Object.keys(loading.value).forEach((key) => (loading.value[key] = true));

        // Fetch data using Inertia
        const response = await router.visit("/dashboard", {
          data: { date },
          only: [
            "customersCount",
            "productsCount",
            "paidOrders",
            "totalIncome",
            "ordersByCountry",
            "latestCustomers",
            "latestOrders",
          ],
          preserveState: true,
          method: "get",
        });

        // Update state
        customersCount.value = response.props.customersCount;
        productsCount.value = response.props.productsCount;
        paidOrders.value = response.props.paidOrders;
        totalIncome.value = new Intl.NumberFormat("en-US", {
          style: "currency",
          currency: "USD",
          minimumFractionDigits: 0,
        }).format(response.props.totalIncome);

        ordersByCountry.value = {
          labels: response.props.ordersByCountry.map((c) => c.name),
          datasets: [
            {
              backgroundColor: ["#41B883", "#E46651", "#00D8FF", "#DD1B16"],
              data: response.props.ordersByCountry.map((c) => c.count),
            },
          ],
        };

        latestCustomers.value = response.props.latestCustomers;
        latestOrders.value = response.props.latestOrders;
      } catch (error) {
        console.error("Failed to fetch dashboard data:", error);
      } finally {
        Object.keys(loading.value).forEach((key) => (loading.value[key] = false));
      }
    }, 300); // Adjust delay
  };

  const onDatePickerChange = () => {
    fetchDashboardData(chosenDate.value);
  };

  return {
    loading,
    customersCount,
    productsCount,
    paidOrders,
    totalIncome,
    ordersByCountry,
    latestCustomers,
    latestOrders,
    dateOptions,
    chosenDate,
    fetchDashboardData,
    onDatePickerChange,
  };
}
