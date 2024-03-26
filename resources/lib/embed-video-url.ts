const youtubeRegex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/
const vimeoRegex = /(?:https?:\/\/)?(?:www\.)?(?:vimeo\.com\/|player\.vimeo\.com\/video\/)([0-9]+)/

/**
 * Check if the given url is a valid youtube or vimeo url
 * Handles youtube and vimeo links including already embedded links
 * @param url
 */
export function checkIfValidYoutubeOrVimeoUrl(url: string) {
  return youtubeRegex.test(url) || vimeoRegex.test(url)
}

/**
 * Get the embed video url from the given url
 * Handles youtube and vimeo links
 * @param url
 */
export function getEmbedVideoUrl(url: string): string {
  const youtubeMatch = url.match(youtubeRegex)
  const vimeoMatch = url.match(vimeoRegex)
  if (youtubeMatch)
    return `https://www.youtube.com/embed/${youtubeMatch[1]}`
  else if (vimeoMatch)
    return `https://player.vimeo.com/video/${vimeoMatch[1]}`

  return url
}
