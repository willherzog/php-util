<?php

namespace WHPHP\Bag;

/**
 * Generic interface for "bag" classes.
 * Inspired by {@link Symfony\Component\HttpFoundation\ParameterBag}.
 *
 * @author Will Herzog <willherzog@gmail.com>
 */
interface GenericBag extends \Iterator
{
	/**
	 * Adds an item to the bag.
	 *
	 * @param $name String key to use for the item
	 * @param $item The item itself
	 *
	 * @return Whether the item could be added (e.g. whether $name is already in use)
	 */
	public function add(string $name, mixed $item): bool;

	/**
	 * Removes an item from the bag.
	 *
	 * @param $name The item to remove
	 *
	 * @return Whether the item could be removed (e.g. whether the item exists)
	 */
	public function remove(string $name): bool;

	/**
	 * Determines whether an item is in the bag.
	 *
	 * @param $name The item to check
	 *
	 * @return Whether the item exists
	 */
	public function has(string $name): bool;

	/**
	 * Fetches an item from the bag.
	 *
	 * @param $name The item to fetch
	 *
	 * @return mixed The requested item or NULL if not present
	 */
	public function get(string $name);

	/**
	 * Returns all items in the bag as a plain array.
	 */
	public function all(): array;

	/**
	 * Determines whether or not this bag is empty.
	 *
	 * @return Whether this bag contains any items
	 */
	public function isEmpty(): bool;
}
