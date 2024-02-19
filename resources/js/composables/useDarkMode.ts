import { onMounted, readonly, ref } from "vue";

type Theme = "system" | "dark" | "light";

const isTheme = (value: string | null): value is Theme =>
  value !== null && ["system", "dark", "light"].includes(value);

export const useDarkMode = () => {
  const darkMode = ref(false);
  const currentTheme = ref<Theme>("system");

  onMounted(() => {
    let lsTheme = localStorage.getItem("theme");
    if (!isTheme(lsTheme)) {
      localStorage.setItem("theme", "system");
      lsTheme = "system";
    }

    syncWithLocalStorage(lsTheme as Theme);
  });

  const syncWithLocalStorage = (mode: Theme) => {
    if (mode === "dark") {
      localStorage.setItem("theme", "dark");
      darkMode.value = true;
      currentTheme.value = "dark";
    }
    if (mode === "light") {
      localStorage.setItem("theme", "light");
      darkMode.value = false;
      currentTheme.value = "light";
    }
    if (mode === "system") {
      localStorage.setItem("theme", "system");
      currentTheme.value = "system";
      if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
        darkMode.value = true;
      } else {
        darkMode.value = false;
      }
    }
  };

  return {
    darkMode: readonly(darkMode),
    currentTheme: readonly(currentTheme),
    setDarkMode: syncWithLocalStorage,
  };
};
