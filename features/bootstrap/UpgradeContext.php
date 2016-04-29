<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Created by PhpStorm.
 * User: alfre
 * Date: 4/17/2016
 * Time: 5:39 PM
 */
class UpgradeContext extends MinkContext implements Context, SnippetAcceptingContext
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('APP_URL');
    }

    /**
     * @Then I should have the top banner and projects under it
     */
    public function iShouldHaveTheTopBannerAndProjectsUnderIt()
    {
        sleep(3);
        $this->assertPageContainsText("Who?");
        $this->assertPageContainsText("Resume doc version and");
        $this->assertPageContainsText("ENV file Deployer");
        $this->assertPageContainsText("BehatEditor v2 coming along");
        $this->assertPageContainsText("Angular Laravel PDF");
    }

    /**
     * @Then it should have the needed menu area
     */
    public function itShouldHaveTheNeededMenuArea()
    {
        $this->clickLink('About');
        $this->iAmOnHomepage();
        $this->assertPageContainsText('Products');
        $this->iAmOnHomepage();
        $this->clickLink('Talks');
    }

    /**
     * @Then it should have tags
     */
    public function itShouldHaveTags()
    {
        $this->iAmOnHomepage();
        $this->assertPageContainsText('REST');
        $this->assertPageContainsText('PHP');
        $this->assertPageContainsText('Angular');
        $this->assertPageContainsText('Laravel');
    }

    /**
     * @Then it should have a quote as well as a photo of me
     */
    public function itShouldHaveAQuoteAsWellAsAPhotoOfMe()
    {
        $this->assertElementOnPage('#about-circle');
    }

    /**
     * @Then the footer should have my contact info and working links
     */
    public function theFooterShouldHaveMyContactInfoAndWorkingLinks()
    {
        $this->clickLink("DOC Here");
        $this->iAmOnHomepage();
        $this->assertPageContainsText('PO Box 72');
        $this->assertPageContainsText('345-5103');
        $this->assertElementOnPage('#twitter');
        $this->assertElementOnPage('#feed');
        $this->assertElementOnPage('#github');
    }

    /**
     * @Given I am on about page
     */
    public function iAmOnAboutPage()
    {
        $this->visit(route('about'));
    }

    /**
     * @Then it should have the Software Writer intro
     */
    public function itShouldHaveTheSoftwareWriterIntro()
    {
        $this->assertPageContainsText('Software Writer and System Architect');
        $this->assertPageContainsText('Over 8 years building');
        $this->assertPageContainsText('Over 15 years');
    }

    /**
     * @Then it should show my sites
     */
    public function itShouldShowMySites()
    {
       $this->assertPageContainsText('Sites');
       $this->assertPageContainsText('long list of sites');
       $this->assertPageContainsText('activeliving');
       $this->assertPageContainsText('harvard');
       $this->assertPageContainsText('fuller');
    }

    /**
     * @Then it should show my more info links
     */
    public function itShouldShowMyMoreInfoLinks()
    {
        $this->assertPageContainsText('More info');
        $this->assertPageContainsText('PDF Here');
    }

    /**
     * @Given I am on products page
     */
    public function iAmOnProductsPage()
    {
        $this->visit(route('products'));
    }

    /**
     * @Then it should have the ReadOrListen.com
     */
    public function itShouldHaveTheReadorlistenCom()
    {
        $this->assertPageContainsText('ReadOrListen.com');
    }

    /**
     * @Then it should show statuschecker class
     */
    public function itShouldShowStatuscheckerClass()
    {
        $this->assertElementOnPage(".statuschecker");
    }

    /**
     * @Given I am on SearchAPI page
     */
    public function iAmOnSearchapiPage()
    {
        $this->visit(route('search_api'));
        sleep(2);
    }

    /**
     * @Then there should be json goodness on the page
     */
    public function thereShouldBeJsonGoodnessOnThePage()
    {
        $results = $this->getSession()->getPage()->getContent();

        PHPUnit_Framework_Assert::assertContains('DrupalCamp Western Mass', $results);
    }
}
