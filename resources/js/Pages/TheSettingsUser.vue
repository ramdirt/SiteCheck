<template lang="pug">
Head(title="Настройки")

BreezeAuthenticatedLayout
  .container.mt-4.flex.justify-center
    section
      Card.sc__card(class="w-[20rem]")
        h3.sc__title Настройки

        Form(ref="SettingUser", :model="form", :rules="rules")
          FormItem(label="Ваше имя")
            Input(placeholder="Имя", v-model="form.name")
          FormItem(label="Почта для получения отчетов")
            Input(placeholder="Электронная почта", v-model="form.email")
          FormItem(label="ID Телеграм для получения отчетов")
            Input(placeholder="Электронная почта", v-model="form.telegram_id")
          FormItem(label="Интервал проверки")
            Select(v-model="form.interval")
              Option(
                v-for="item in intervalList",
                :value="item.value",
                :key="item.key",
                :selected="item.value === user.interval"
              ) {{ item.label }}
          FormItem(label="Каналы получения отчетов")
            Checkbox(v-model="form.report_email") Почта
            Checkbox(v-model="form.report_telegram") Телеграм

          .flex.justify-end
            Button(
              type="primary",
              @click="submit",
              :disabled="form.processing"
            ) Обновить
</template>

<script setup>
import { Message } from "view-ui-plus";
import { useForm } from "@inertiajs/inertia-vue3";
import { useStore } from "@/Stores/index";

const store = useStore();

const form = useForm("SettingUser", {
  name: store.user.name,
  email: store.user.email,
  interval: store.user.interval,
  telegram_id: store.user.telegram_id,
  report_email: Boolean(store.user.report_email),
  report_telegram: Boolean(store.user.report_telegram),
});

const rules = {
  name: [{ required: true }],
  email: [{ required: true }],
};

const intervalList = [
  // TODO: Сделать получения параметров интервалов с бэка
  {
    value: 1,
    label: "1 Минута",
  },
  {
    value: 5,
    label: "5 Минут",
  },
  {
    value: 15,
    label: "15 Минут",
  },
];

const submit = () => {
  form.put(route("settings.update", { id: user.id }), {
    onSuccess: () => {
      Message.success("Настройки обновлены");
    },
    onError: (errors) => {
      if (errors.email) {
        return Message.error("Пользователь с такой почтой уже есть");
      }
      Message.error("Ошибка обновления настроек");
    },
  });
};
</script>