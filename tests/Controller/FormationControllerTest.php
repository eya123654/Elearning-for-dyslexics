<?php

namespace App\Test\Controller;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FormationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private FormationRepository $repository;
    private string $path = '/form/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Formation::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Formation index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'formation[nom]' => 'Testing',
            'formation[description]' => 'Testing',
            'formation[thematique]' => 'Testing',
            'formation[nbr_participant]' => 'Testing',
            'formation[niveau]' => 'Testing',
            'formation[sessions]' => 'Testing',
        ]);

        self::assertResponseRedirects('/form/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Formation();
        $fixture->setNom('My Title');
        $fixture->setDescription('My Title');
        $fixture->setThematique('My Title');
        $fixture->setNbr_participant('My Title');
        $fixture->setNiveau('My Title');
        $fixture->setSessions('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Formation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Formation();
        $fixture->setNom('My Title');
        $fixture->setDescription('My Title');
        $fixture->setThematique('My Title');
        $fixture->setNbr_participant('My Title');
        $fixture->setNiveau('My Title');
        $fixture->setSessions('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'formation[nom]' => 'Something New',
            'formation[description]' => 'Something New',
            'formation[thematique]' => 'Something New',
            'formation[nbr_participant]' => 'Something New',
            'formation[niveau]' => 'Something New',
            'formation[sessions]' => 'Something New',
        ]);

        self::assertResponseRedirects('/form/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getThematique());
        self::assertSame('Something New', $fixture[0]->getNbr_participant());
        self::assertSame('Something New', $fixture[0]->getNiveau());
        self::assertSame('Something New', $fixture[0]->getSessions());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Formation();
        $fixture->setNom('My Title');
        $fixture->setDescription('My Title');
        $fixture->setThematique('My Title');
        $fixture->setNbr_participant('My Title');
        $fixture->setNiveau('My Title');
        $fixture->setSessions('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/form/');
    }
}
