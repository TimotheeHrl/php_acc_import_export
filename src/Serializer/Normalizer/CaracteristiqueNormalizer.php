<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use OpenApi\Annotations as OA;

/**
 * class CaracteristiqueNormalizer
 * @package App\Serializer\Normalizer
 * @OA\Schema(
 * schema="CaracteristiqueSingle",
 * type="object",
 * title="Caracteristique all fields",
 * description="Caracteristique des accidents",
 * @OA\Property(property="id", type="integer", description="Identifiant de la caracteristique"),
 * @OA\Property(property="num_acc", type="integer", description="Numéro d'accident"),
 * @OA\Property(property="jour", type="integer", description="jour de l'accident"),
 * @OA\Property(property="mois", type="integer", description="mois de l'accident"),
 * @OA\Property(property="an", type="integer", description="année de l'accident"),
 * @OA\Property(property="hrmn", type="string", description="heure de l'accident"),
 * @OA\Property(property="lum", type="integer", description="lumière au moment de l'accident"),
 * @OA\Property(property="agg", type="integer", description="dans agglomeration/hors agglomeration"),
 * @OA\Property(property="int", type="integer", description="intersection de l'accident"),
 * @OA\Property(property="atm", type="integer", description="condition metéos de l'accident"),
 * @OA\Property(property="col", type="integer", description="type de collision de l'accident"),
 * @OA\Property(property="com", type="integer", description="code commune de l'accident"),
 * @OA\Property(property="dep", type="integer", description="code département de l'accident"),
 * @OA\Property(property="adr", type="string", description="adresse postale"),
 * @OA\Property(property="lat", type="integer", description="latitude"),
 * @OA\Property(property="longi", type="integer", description="longitude"),
 * )
 * @OA\Schema(
 * schema="CaracteristiqueDisplayOnMap",
 * type="object",
 * title="Caracteristique for display on a map",
 * description="Caracteristique des accidents",
 * @OA\Property(property="id", type="integer", description="Identifiant de la caracteristique"),
 * @OA\Property(property="num_acc", type="integer", description="Numéro d'accident"),
 * @OA\Property(property="lum", type="integer", description="lumière au moment de l'accident"),
 * @OA\Property(property="lat", type="integer", description="latitude"),
 * @OA\Property(property="longi", type="integer", description="longitude"),
 * )
 */
class CaracteristiqueNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($object, string $format = null, array $context = []): array
    {
        $data = $this->normalizer->normalize($object, $format, $context);

        // TODO: add, edit, or delete some data

        return $data;
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof \App\Entity\Caracteristique;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
