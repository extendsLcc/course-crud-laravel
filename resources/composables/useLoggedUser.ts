export function useLoggedUser() {
  const globalProps = useProperties()
  if (!globalProps.security.user) {
    router.navigate({
      url: route('auth.show'),
    })
    throw new Error('User not logged in')
  }
  return globalProps.security.user
}
