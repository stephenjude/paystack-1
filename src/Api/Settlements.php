<?php
/**
 *
 * This file is part of the Xeviant Paystack package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package          Paystack
 * @version          1.0
 * @author           Olatunbosun Egberinde
 * @license          MIT Licence
 * @copyright        (c) Olatunbosun Egberinde <bosunski@gmail.com>
 * @link             https://github.com/bosunski/paystack
 *
 */

namespace Xeviant\Paystack\Api;


use Illuminate\Support\Collection;
use Xeviant\Paystack\Contract\ModelAware;

class Settlements extends AbstractApi implements ModelAware
{
	const BASE_PATH = '/settlement';

    /**
     * Retrieves all Settlements
     *
     * @param array $parameters
     * @return Collection
     * @throws \Http\Client\Exception
     */
	public function list(array $parameters = []): Collection
	{
		return $this->get(self::BASE_PATH, $parameters)->map(function ($settlement) {
		    return $this->getApiModel($settlement);
        });
	}

    /**
     * Retrieves Model accessor inside container
     *
     * @return string
     */
    public function getApiModelAccessor(): string
    {
        return 'settlement';
    }
}
