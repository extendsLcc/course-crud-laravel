type CallbackFunction = () => void

/**
 * Provides a loading state for the navigation event.
 * Provides success callback
 * Provides error callback
 * Not looking for supporting all use-cases for now.
 */
export function useNavigationEvent() {
  const isNavigating = ref(false)
  const onSuccessCallback = ref<CallbackFunction>()
  const onErrorCallback = ref<CallbackFunction>()

  registerHook('start', () => isNavigating.value = true)
  registerHook('after', () => isNavigating.value = false)
  registerHook('success', () => onSuccessCallback.value?.())
  registerHook('fail', () => onErrorCallback.value?.())

  return {
    isNavigating: isNavigating.value,
    onSuccess: (callback: CallbackFunction) => {
      onSuccessCallback.value = callback
      return onSuccessCallback
    },
    onErrorCallback: (callback: CallbackFunction) => {
      onErrorCallback.value = callback
      return onErrorCallback
    },
  } as const
}
