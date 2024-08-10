<?php

namespace UniPayment\SDK;

use UniPayment\SDK\Model\QueryWalletTransactionsRequest;
use UniPayment\SDK\Model\TransactionType;
use UniPayment\SDK\Model\WalletAccount;

class WalletAPITest extends BaseTest
{
    /**
     * Test case for getBalances
     * @throws UnipaymentSDKException
     */
    public function testGetBalances()
    {
        $getWalletBalancesResponse = $this->walletAPI->getBalances();
        $this->assertNotNull($getWalletBalancesResponse);
        $this->assertEquals('OK', $getWalletBalancesResponse->getCode());
    }

    /**
     * Test case for getAccounts
     * @throws UnipaymentSDKException
     */
    public function testGetAccounts()
    {
        $getWalletAccountsResponse = $this->walletAPI->getAccounts();
        $this->assertNotNull($getWalletAccountsResponse);
        $this->assertEquals('OK', $getWalletAccountsResponse->getCode());
    }

    /**
     * Test case for queryTransactions
     * @throws UnipaymentSDKException
     */
    public function testQueryTransactions()
    {
        $getWalletAccountsResponse = $this->walletAPI->getAccounts();
        $accounts = array_filter($getWalletAccountsResponse->getData(), function (WalletAccount $account) {
            return $account->getAssetType() === 'USD';
        });

        $accountId = reset($accounts)->getId();
        $queryWalletTransactionsRequest = new QueryWalletTransactionsRequest();
        $queryWalletTransactionsRequest->setTransactionType(TransactionType::PAYMENT);
        $getWalletAccountsResponse = $this->walletAPI->queryTransactions($accountId, $queryWalletTransactionsRequest);
        $this->assertNotNull($getWalletAccountsResponse);
        $this->assertEquals('OK', $getWalletAccountsResponse->getCode());
    }

    /**
     * Test case for getDepositAddress
     * @throws UnipaymentSDKException
     */
    public function testGetDepositAddress()
    {
        $getWalletAccountsResponse = $this->walletAPI->getAccounts();
        $accounts = array_filter($getWalletAccountsResponse->getData(), function (WalletAccount $account) {
            return $account->getAssetType() === 'BTC';
        });
        $accountId = reset($accounts)->getId();
        $getDepositAddressResponse = $this->walletAPI->getDepositAddress($accountId);
        $this->assertNotNull($getDepositAddressResponse);
        $this->assertEquals('OK', $getDepositAddressResponse->getCode());
    }

    /**
     * Test case for getDepositBankAccount
     * @throws UnipaymentSDKException
     */
    public function testGetDepositBankAccount()
    {
        $getWalletAccountsResponse = $this->walletAPI->getAccounts();
        $accounts = array_filter($getWalletAccountsResponse->getData(), function (WalletAccount $account) {
            return $account->getAssetType() === 'USD';
        });
        $accountId = reset($accounts)->getId();
        $getDepositBankAccountResponse = $this->walletAPI->getDepositBankAccount($accountId);
        $this->assertNotNull($getDepositBankAccountResponse);
        $this->assertEquals('OK', $getDepositBankAccountResponse->getCode());
    }
}