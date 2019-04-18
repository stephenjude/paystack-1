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

use Xeviant\Paystack\Contract\EventType;

class Charge extends AbstractApi
{
	const BASE_PATH = '/charge';

    /**
     * Creates a Charge
     *
     * @param array $parameters
     * @return array|string
     * @throws \Http\Client\Exception
     */
	public function charge(array $parameters)
	{
		$this->validator->setRequiredParameters(['email', 'amount', 'card.number', 'card.cvv', 'card.expiry_month', 'card.expiry_year', 'bank.code', 'bank.account_number']);

		if ($this->validator->checkParameters($parameters)) {
			$response = $this->post(self::BASE_PATH, $parameters);

			if ($response['status'] ?? null) {
			    $this->fire(
			        EventType::CHARGE_SUCCESS,
                    $response['data']
                );
            }

			return $response;
		}
	}

    /**
     * Submits a PIN
     *
     * @param array $parameters
     * @return array|string
     * @throws \Http\Client\Exception
     */
	public function submitPin(array $parameters)
	{
		$this->validator->setRequiredParameters(['pin', 'reference']);

		if ($this->validator->checkParameters($parameters)) {
			return $this->post(self::BASE_PATH . '/submit_pin', $parameters);
		}
	}

    /**
     * Submits OTP for Charge
     *
     * @param array $parameters
     * @return array|string
     * @throws \Http\Client\Exception
     */
	public function submitOtp(array $parameters)
	{
		$this->validator->setRequiredParameters(['otp', 'reference']);

		if ($this->validator->checkParameters($parameters)) {
			return $this->post(self::BASE_PATH . '/submit_otp', $parameters);
		}
	}

    /**
     * Submits Phone for Charge
     *
     * @param array $parameters
     * @return array|string
     * @throws \Http\Client\Exception
     */
	public function submitPhone(array $parameters)
	{
		$this->validator->setRequiredParameters(['phone', 'reference']);

		if ($this->validator->checkParameters($parameters)) {
			return $this->post(self::BASE_PATH . '/submit_phone', $parameters);
		}
	}

    /**
     * Submits Birthday for charge
     *
     * @param array $parameters
     * @return array|string
     * @throws \Http\Client\Exception
     */
	public function submitBirthday(array $parameters)
	{
		$this->validator->setRequiredParameters(['birthday', 'reference']);

		if ($this->validator->checkParameters($parameters)) {
			return $this->post(self::BASE_PATH . '/submit_birthday', $parameters);
		}
	}

    /**
     * Checks a Pending Charge
     *
     * @param string $reference
     *
     * @return array|string
     * @throws \Xeviant\Paystack\Exception\MissingArgumentException
     * @throws \Http\Client\Exception
     */
	public function checkPendingCharge(string $reference)
	{
		if ($this->validator->checkParameter($reference)) {
			return $this->get(self::BASE_PATH . "/$reference");
		}
	}
}
