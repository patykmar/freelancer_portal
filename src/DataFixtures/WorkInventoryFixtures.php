<?php


namespace App\DataFixtures;


use App\Entity\WorkInventory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use DateTime;
use Exception;

class WorkInventoryFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            TariffFixture::class,
            CompanyFixture::class,
            UserFixture::class,
        ];
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $companies = [
            $this->getReference(CompanyFixture::COMPANY_O2_CZ),
            $this->getReference(CompanyFixture::COMPANY_TMOBILE_CZ),
            $this->getReference(CompanyFixture::COMPANY_CEZ),
            $this->getReference(CompanyFixture::COMPANY_CETIN_CZ),
            $this->getReference(CompanyFixture::COMPANY_VODAFONE_CZ),
        ];

        $users = [
            $this->getReference(UserFixture::USER_FIXTURE_01),
            $this->getReference(UserFixture::USER_FIXTURE_02),
        ];

        $tariffs = [
            $this->getReference(TariffFixture::CZK_299),
            $this->getReference(TariffFixture::CZK_399),
            $this->getReference(TariffFixture::CZK_499),
            $this->getReference(TariffFixture::CZK_450),
            $this->getReference(TariffFixture::CZK_600),
            $this->getReference(TariffFixture::CZK_699),
            $this->getReference(TariffFixture::CZK_999),
        ];

        $sentences = [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Nam at congue nulla.',
            'Sed a sodales leo, fermentum lobortis tellus.', 'Morbi et risus sed enim consequat auctor id convallis massa.',
            'Duis lacus enim, accumsan eget tristique sed, viverra et augue.', 'Curabitur ut sodales ante.',
            'Sed vestibulum, erat eget tincidunt egestas, sem metus eleifend erat, vel suscipit est ante id arcu.',
            'Nunc laoreet, quam sit amet pretium ultricies, justo nisi placerat libero, a molestie dolor odio vel nisl.',
            'In hac habitasse platea dictumst.', 'Suspendisse massa arcu, laoreet eget cursus non, vulputate eget diam.',
            'Vestibulum nisl sapien, pellentesque non consectetur et, finibus eget elit.', 'Phasellus quis tincidunt arcu.',
            'Suspendisse sed lectus dui.', 'In laoreet libero orci, sed tincidunt sapien viverra eget.',
            'Nam erat mauris, hendrerit sed varius id, aliquet id arcu.',
            'Quisque elementum, nulla id sollicitudin volutpat, metus nunc pretium nisi, in varius massa lectus vitae sapien.',
            'Nulla facilisi.', 'Suspendisse ac nisi laoreet, vulputate augue eget, porttitor arcu.',
            'Etiam vel urna ullamcorper, dignissim urna non, consequat ex.', 'Duis tempor nibh sapien.',
            'Donec pellentesque arcu quis feugiat dapibus.', 'Sed consequat enim et neque iaculis elementum.',
            'Nulla massa metus, vestibulum ut eros a, feugiat vehicula tortor.',
            'Pellentesque tristique molestie tortor posuere rutrum.', 'Praesent porttitor magna id ligula congue, a scelerisque ligula fringilla.',
            'Proin non suscipit sapien.'
        ];

        for ($i = 0; $i < rand(50, 500); $i++) {
            $wif = new WorkInventory();
            $wif->setUser($users[rand(0, count($users) - 1)])
                ->setCompany($companies[rand(0, count($companies) - 1)])
                ->setTariff($tariffs[rand(0, count($tariffs) - 1)])
                ->setDescription($sentences[rand(0, count($sentences) - 1)])
                ->setWorkStart(new DateTime('@' . rand((time() - (rand(50, 9999) * 60)), (time() + (rand(0, 999) * 60)))))
                ->setWorkEnd(new DateTime('@' . rand((time() - (rand(50, 9999) * 60)), (time() + (rand(0, 999) * 60)))));
            $manager->persist($wif);
            unset($wif);
        }
        $manager->flush();
    }
}