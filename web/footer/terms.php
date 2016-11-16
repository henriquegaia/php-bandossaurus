<?php
$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
include $config['file']['ov_header'];
Presentation::print_page_title('Terms');
?>
<div>

    <?php include $config['file']['footer_intro_def'];?>
<p>
<h2>3. What <?php echo $config['company']['name']; ?> Offers</h2>
</p>
<p>
    <?php echo $config['company']['name']; ?> provides the best matches depending on who the User is searching for (musician, band or agent).
</p>
<p>
    <?php echo $config['company']['name']; ?> also provides the possibility of searching for musicians, bands and agents based on a number of criteria.
    <br/>
    <br/>
    <?php echo $config['company']['name']; ?> has free and paid plans. Our free plan gives Users access to all of the tabs.
    <br/>
    <br/>
    Our paid plan unlocks: a) the unlimited messages to other Users; b) the possibility of filtering users by proximity; c) unlimited invitations; d) knowing the top matches with other roles
    <br/>
    <br/>
</p>
<p>
<h2>4. Eligibility</h2>
</p>
<p>
    In order to use our Service, you must meet a number of conditions, including but not limited to:
</p>
<ul>
    <li>  You must not be in violation of any embargoes, export controls, or other laws of Portugal or other countries having jurisdiction over this
        Agreement, <?php echo $config['company']['name']; ?>, and yourself. For example, if the Office of Foreign Assets Control prohibits conducting financial transactions with nationals,
        residents, or banks of your country, you must not use our Service. </li>
    <li> You must be the minimum age required to enter into a contract in the area in which you reside, and, in any event, must not be less than 18 years of age. </li>
    <li> You must provide us with personal information, payment information, and other information that we deem necessary to provide you with our Service, and any
        such information must be accurate. </li>
</ul>
<p>
<h2>5. Rules of Use</h2>
</p>
<p>
    The above eligibility criteria are only initial rules for signing up for our Service. In addition to the above rules, you must not:
</p>
<ul>
    <li>  Violate the laws of Portugal or any foreign political entity having jurisdiction over this Agreement, whether or not the foreign
        political entity is a country or a subdivision (such as a state or province) or municipality (such as a city, town, county, or region) of a foreign
        country. </li>
    <li> Post anything which is objectionable according to the opinion of <?php echo $config['company']['name']; ?>. </li>
    <li> Post fake profile (for example, by describing your musical experience other than what it actually is). </li>
    <li> Infringe on anyone’s intellectual property rights, defame anyone, impersonate anyone, or otherwise violate the rights of a third party. </li>
    <li> Hack, crack, phish, SQL inject, or otherwise compromise the security or integrity of the <?php echo $config['company']['name']; ?> Site, Service, or its Users’ computers. </li>
    <li> Do anything else which, at <?php echo $config['company']['name']; ?>’s discretion, could bring <?php echo $config['company']['name']; ?> into disrepute or violate the rights of <?php echo $config['company']['name']; ?> or any other person. </li>
</ul>
<p>
<h2>6. Payment</h2>
</p>
<p>
    Payment can be made by credit only. Your payment information will be collected by Paypal.
    Unless otherwise stated, all prices are listed in United States dollars. Payment terms and, if applicable, subscription rebilling
    information, will be posted on our Site and are hereby incorporated into this Agreement by reference.
</p>
<p>
    Should you believe that a refund is in order for any reason, please contact <a href="<?php echo Project::$email_support; ?>"><?php echo Project::$email_support; ?></a>. Although we
    do not undertake to refund any person for any reason, we will evaluate refund requests on a case-by-case basis and, if we believe it is merited, may
    exercise our discretion and refund a person upon request.
</p>
<p>
<h2>7. Discounts</h2>
</p>
<p>
    <?php echo $config['company']['name']; ?> may, from time to time, provide discounts, coupons, or other promotions. <?php echo $config['company']['name']; ?> may refuse to provide such discounts for any reason including,
    but not limited to, fraud, mistake on the part of our publication of information, actual or expected financial hardship, sale of all or part of our
    business, or any other reason.
</p>
<p>
<h2>8. Chargebacks and PayPal Disputes</h2>
</p>
<p>
    Where a User provides payment to <?php echo $config['company']['name']; ?> through PayPal, and that amount of money is subsequently taken from <?php echo $config['company']['name']; ?> due to a chargeback,
    credit card cancellation, PayPal dispute, or other action that is the fault of the User, <?php echo $config['company']['name']; ?> shall be entitled to recover that amount from the User.
    Users may, of course, bring a dispute in accordance with the “Forum of Dispute” provisions of this Agreement.
</p>
<p>
<h2>9. Our Copyright</h2>
</p>
<p>
    <?php echo $config['company']['name']; ?> has a copyright in the content that it creates. Additionally, Users or other parties may have content posted on the Site which is owned by the
    Users, or some third party, and licensed to <?php echo $config['company']['name']; ?> for its use. You agree not to copy, distribute, display, disseminate, or otherwise reproduce any of
    the information on the Site, regardless of whether such content is posted by <?php echo $config['company']['name']; ?> or by a third party, without
    receiving our prior written permission.
</p>
<p>
<h2>10. Your Copyright</h2>
</p>
<p>
    <?php echo $config['company']['name']; ?> must be assured that it has the right to use the content that is posted to its Site by its Users. Such content may include, but is not limited
    to, photographs, videos, text, audio, and other materials. Whenever submitting content to our website, you agree that you are granting us a non-exclusive,
    universal, perpetual, irrevocable, sublicensable, commercial and non-commercial right to use, distribute, sell, publish, and otherwise make use of the
    content that you submit to us.
</p>
<p>
    In the event that you do not have any right to grant such a right to us
    <?php echo $config['company']['name']; ?> shall have as many rights over that content as it may be granted by any third party whose copyright subsists in that work.
</p>
<p>
<h2>11. Trademarks</h2>
</p>
<p>
    “<?php echo $config['company']['name']; ?>” is a trademark used by us to uniquely identify our Site, Service, and business. You agree not to use this phrase anywhere
    without our prior written consent. Additionally, you agree not to use our trade dress, or copy the look and feel of our website or its design, without our
    prior written consent. You agree that this paragraph goes beyond the governing law on intellectual property law, and includes prohibitions on any
    competition that violates the provisions of this paragraph, including starting your own music-related business.
</p>
<p>
<h2>12. Revocation of Consent</h2>
</p>
<p>
    We may revoke our consent for your use of our intellectual property, or any other permission granted to you under this Agreement, at any time. You agree
    that if we so request, you must take immediate action to remove any usage of our intellectual property that you may have engaged in, even if it would cause
    a loss to you.
</p>
<p>
<h2>13. Copyright &amp; Trademark Infringement</h2>
</p>
<p>
    If you believe that your copyright has been infringed, regardless of whether it is as a result of a
    lack of a license provided or otherwise, please send us a message which contains:
</p>
<ul>
    <li> Your name. </li>
    <li> The name of the party whose copyright has been infringed, if different from your name.</li>
    <li> The name and description of the work that is being infringed.</li>
    <li> The location on our website of the infringing copy.</li>
    <li> A statement that you have a good faith belief that use of the copyrighted work described above is not authorized by the copyright owner (or by a third
        party who is legally entitled to do so on behalf of the copyright owner) and is not otherwise permitted by law.</li>
    <li> A statement that you swear, under penalty of perjury, that the information contained in this notification is accurate and that you are the copyright
        owner or have an exclusive right in law to bring infringement proceedings with respect to its use.</li>
</ul>
<p>
    You must sign this notification electronically and send it to our Copyright Agent at <a href="<?php echo Project::$email_support; ?>"><?php echo Project::$email_support; ?></a>.
</p>
<p>
    Although U.S. law does not provide for a similar procedure for trademark infringement, we recommend that you send us similar information to that above in
    regards to any allegation of trademark infringement, and we will address it as soon as practicable.
</p>
<p>
<h2>14. Representations &amp; Warranties</h2>
</p>
<p>
    WE MAKE NO REPRESENTATIONS OR WARRANTIES AS TO THE MERCHANTABILITY OF OUR SERVICE OR FITNESS FOR ANY PARTICULAR PURPOSE. YOU AGREE THAT YOU ARE RELEASING
    US FROM ANY LIABILITY THAT WE MAY OTHERWISE HAVE TO YOU IN RELATION TO OR ARISING FROM THIS AGREEMENT OR OUR SERVICES, FOR REASONS INCLUDING, BUT NOT
    LIMITED TO, FAILURE OF OUR SERVICE, NEGLIGENCE, OR ANY OTHER TORT. TO THE EXTENT THAT APPLICABLE LAW RESTRICTS THIS RELEASE OF LIABILITY, YOU AGREE THAT WE
    ARE ONLY LIABLE TO YOU FOR THE MINIMUM AMOUNT OF DAMAGES THAT THE LAW RESTRICTS OUR LIABILITY TO, IF SUCH A MINIMUM EXISTS.
</p>
<p>
    YOU AGREE THAT WE ARE NOT RESPONSIBLE IN ANY WAY FOR DAMAGES CAUSED BY THIRD PARTIES WHO MAY USE OUR SERVICES, INCLUDING BUT NOT LIMITED TO PEOPLE WHO
    COMMIT INTELLECTUAL PROPERTY INFRINGEMENT, DEFAMATION, TORTIOUS INTERFERENCE WITH ECONOMIC RELATIONS, OR ANY OTHER ACTIONABLE CONDUCT TOWARDS YOU.
</p>
<p>
    WE ARE NOT RESPONSIBLE FOR ANY FAILURE ON THE PART OF A PAYMENT PROCESSOR, INCLUDING PAYPAL OR THE CREDIT CARD COMPANY OR BANK THAT YOU USE TO
    FUND PAYPAL, TO DIRECT PAYMENTS TO THE CORRECT DESTINATION, OR ANY ACTIONS ON THEIR PART IN PLACING A HOLD ON YOUR FUNDS.
</p>
<p>
    WE ARE NOT LIABLE FOR ANY FAILURE OF THE GOODS OR SERVICES OF OUR COMPANY OR A THIRD PARTY, INCLUDING ANY FAILURES OR DISRUPTIONS, UNTIMELY DELIVERY,
    SCHEDULED OR UNSCHEDULED, INTENTIONAL OR UNINTENTIONAL, ON OUR WEBSITE WHICH PREVENT ACCESS TO OUR WEBSITE TEMPORARILY OR PERMANENTLY.
</p>
<p>
    THE PROVISION OF OUR SERVICE TO YOU IS CONTINGENT ON YOUR AGREEMENT WITH THIS AND ALL OTHER SECTIONS OF THIS AGREEMENT. NOTHING IN THE PROVISIONS OF THIS
    “REPRESENTATIONS &amp; WARRANTIES” SECTION SHALL BE CONSTRUED TO LIMIT THE GENERALITY OF THE FIRST PARAGRAPH OF THIS SECTION.
</p>
<p>
    <strong><em>For Jurisdictions that do not allow us to limit our liability:</em></strong>
    Notwithstanding any provision of these Terms, if your jurisdiction has provisions specific to waiver or liability that conflict with the above then our
    liability is limited to the smallest extent possible by law. Specifically, in those jurisdictions not allowed, we do not disclaim liability for: (a) death
    or personal injury caused by its negligence or that of any of its officers, employees or agents; or (b) fraudulent misrepresentation; or (c) any liability
    which it is not lawful to exclude either now or in the future.
</p>
<p>
    IF YOU ARE A RESIDENT OF A JURISDICTION THAT REQUIRES A SPECIFIC STATEMENT REGARDING RELEASE THEN THE FOLLOWING APPLIES. FOR EXAMPLE, CALIFORNIA RESIDENTS
    MUST, AS A CONDITION OF THIS AGREEMENT, WAIVE THE APPLICABILITY OF CALIFORNIA CIVIL CODE SECTION 1542, WHICH STATES, “A GENERAL RELEASE DOES NOT EXTEND TO
    CLAIMS WHICH THE CREDITOR DOES NOT KNOW OR SUSPECT TO EXIST IN HIS OR HER FAVOR AT THE TIME OF EXECUTING THE RELEASE, WHICH IF KNOWN BY HIM OR HER MUST
    HAVE MATERIALLY AFFECTED HIS OR HER SETTLEMENT WITH THE DEBTOR." YOU HEREBY WAIVE THIS SECTION OF THE CALIFORNIA CIVIL CODE. YOU HEREBY WAIVE ANY SIMILAR
    PROVISION IN LAW, REGULATION, OR CODE THAT HAS THE SAME INTENT OR EFFECT AS THE AFOREMENTIONED RELEASE.
</p>
<p>
<h2>15. Indemnity</h2>
</p>
<p>
    You agree to indemnify and hold us harmless for any claims by you or any third party which may arise from or relate to this Agreement or the provision of
    our service to you, including any damages caused by your use of our Site or acceptance of the offers contained on it. You also agree that you have a duty
    to defend us against such claims and we may require you to pay for an attorney(s) of our choice in such cases. You agree that this indemnity extends to
    requiring you to pay for our reasonable attorneys’ fees, court costs, and disbursements. In the event of a claim such as one described in this paragraph,
    we may elect to settle with the party/parties making the claim, and you shall be liable for the damages as though we had proceeded with a trial.
</p>
<p>
<h2>16. Choice of Law</h2>
</p>
<p>
    This Agreement shall be governed by the laws in Portugal. The offer and acceptance of this contract are deemed
    to have occurred in Portugal.</p>
<p>
<h2>17. Forum of Dispute</h2>
</p>
<p>
    You agree that any dispute arising from or relating to this Agreement will be heard solely by a court of competent jurisdiction in Portugal.
</p>
<p>
    If you bring a dispute in a manner other than in accordance with this section, you agree that we may move to have it dismissed, and that you will be
    responsible for our reasonable attorneys’ fees, court costs, and disbursements in doing so.
</p>
<p>
    You agree that the unsuccessful party in any dispute arising from or relating to this Agreement will be responsible for the reimbursement of the successful
    party’s reasonable attorneys’ fees, court costs, and disbursements.
</p>
<p>
<h2>18. Force Majeure</h2>
</p>
<p>
    You agree that we are not responsible to you for anything that we may otherwise be responsible for, if it is the result of events beyond our control,
    including, but not limited to, acts of God, war, insurrection, riots, terrorism, crime, labor shortages (including lawful and unlawful strikes), embargoes,
    postal disruption, communication disruption, unavailability of payment processors, failure or shortage of infrastructure, shortage of materials, or any
    other event beyond our control.
</p>
<p>
<h2>19. Severability</h2>
</p>
<p>
    In the event that a provision of this Agreement is found to be unlawful, conflicting with another provision of the Agreement, or otherwise unenforceable,
    the Agreement will remain in force as though it had been entered into without that unenforceable provision being included in it.
</p>
<p>
    If two or more provisions of this Agreement are deemed to conflict with each other’s operation, <?php echo $config['company']['name']; ?> shall have the sole right to elect which
    provision remains in force.
</p>
<p>
<h2>20. Non-Waiver</h2>
</p>
<p>
    <?php echo $config['company']['name']; ?> reserves all rights afforded to us under this Agreement as well as under the provisions of any applicable law. Our non-enforcement of any
    particular provision or provisions of this Agreement or the any applicable law should not be construed as our waiver of the right to enforce that same
    provision under the same or different circumstances at any time in the future.
</p>
<p>
<h2>21. Termination &amp; Cancellation</h2>
</p>
<p>
    We may terminate your account or access as well as access to our Site and Service to you at our discretion without explanation, though we will strive to
    provide a timely explanation in most cases. Our liability for refunding you, if you have paid anything to us, will be limited to the amount you paid for
    goods or services which have not yet been and will not be delivered, except in cases where the termination or cancellation was due to your breach of this
    Agreement, in which case you agree that we are not required to provide any refund or other compensation whatsoever.
</p>
<p>
    Under no circumstances, including termination or cancellation of our Service to you, will we be liable for any losses related to actions of other Users.
</p>
<p>
<h2>22. Assignment of Rights</h2>
</p>
<p>
    You may not assign your rights and/or obligations under this Agreement to any other party without our prior written consent. We may assign our rights
    and/or obligations under this Agreement to any other party at our discretion.
</p>
<p>
<h2>23. Amendments</h2>
</p>
<p>
    We may amend this Agreement from time to time. When we amend this Agreement, we will update this page. You must read this page each time you access our
    Service, and you agree that your continued use of our Service constitutes your agreement with any such amendments.
</p>
<p>
    Last Modified: August 24, 2016
</p>
</div>

<?php
include $config['file']['ov_footer'];
