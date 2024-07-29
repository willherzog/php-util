<?php

namespace WHPHP\Util;

/**
 * Utility methods for working with URLs.
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
final class UrlUtil
{
	private function __construct()
	{}

	/**
	 * Uses {@link http_build_query()} to convert an array to a valid URL query string and safely† appends it to (and then returns) the given `$url` string.
	 * † "safely" meaning that this function accounts for whether the `$url` argument already has query parameters or already ends with a "?".
	 *
	 * @param string $url
	 * @param array $queryParams
	 * @param int $encodingType Optional; defaults to (constant) `PHP_QUERY_RFC1738`, but you can also use (constant) `PHP_QUERY_RFC3986`
	 * @param string $numericPrefix Optional; see the official documentation for {@link http_build_query()}: <https://www.php.net/manual/en/function.http-build-query.php>
	 * @param string $querySeparator Optional; defaults to ampersand (i.e. "&")
	 */
	static public function appendUrlQueryParams(string $url, array $queryParams, int $encodingType = \PHP_QUERY_RFC1738, string $numericPrefix = '', string $querySeparator = '&'): string
	{
		if( count($queryParams) > 0 ) {
			$queryString = http_build_query($queryParams, $numericPrefix, $querySeparator, $encodingType);

			if( strlen($queryString) > 0 ) {
				if( str_contains($url, '?') && !empty(parse_url($url, \PHP_URL_QUERY)) && !str_ends_with($url, $querySeparator) ) {
					$url .= $querySeparator;
				} elseif( !str_ends_with($url, '?') ) {
					$url .= '?';
				}

				$url .= $queryString;
			}
		}

		return $url;
	}

	/**
	 * Remove URL scheme and--if there are no path, query or fragment portions--remove the ending forward slash.
	 */
	static public function formatForDisplay(string $url): string
	{
		$urlParts = parse_url($url);

		if( is_array($urlParts) ) {
			if( isset($urlParts['scheme']) ) {
				$url = substr($url, strlen($urlParts['scheme'] . '://'));
			}

			$urlHasNonDomainNameParts = false;

			foreach( ['path','query','fragment'] as $nonDomainNamePart ) {
				if( isset($urlParts[$nonDomainNamePart]) && strlen($urlParts[$nonDomainNamePart]) > 0 ) {
					$urlHasNonDomainNameParts = true;
					break;
				}
			}

			if( $urlHasNonDomainNameParts && str_ends_with($url, '/') ) {
				$url = substr($url, 0, -1);
			}
		}

		return $url;
	}
}
