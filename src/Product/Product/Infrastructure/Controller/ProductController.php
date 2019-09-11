<?php

namespace CTIC\Product\Product\Infrastructure\Controller;

use CTIC\App\Base\Domain\EntityInterface;
use CTIC\App\Base\Infrastructure\Controller\ResourceController;
use CTIC\App\Base\Infrastructure\Request\RequestConfiguration;
use CTIC\Product\Product\Application\CreateProductVariantComposed;
use CTIC\Product\Product\Application\CreateProductVariantComposedComplement;
use CTIC\Product\Product\Application\CreateProductVariantRate;
use CTIC\Product\Product\Domain\Command\ProductVariantComposedCommand;
use CTIC\Product\Product\Domain\Command\ProductVariantComposedComplementCommand;
use CTIC\Product\Product\Domain\Command\ProductVariantRateCommand;
use CTIC\Product\Product\Domain\Product;
use CTIC\Product\Product\Domain\ProductDevice;
use CTIC\Product\Product\Domain\ProductObservation;
use CTIC\Product\Product\Domain\ProductVariant;
use CTIC\Product\Product\Domain\ProductVariantComposed;
use CTIC\Product\Product\Domain\ProductVariantComposedComplement;
use CTIC\Product\Product\Domain\ProductVariantRate;
use CTIC\Product\Product\Infrastructure\Repository\ProductVariantRepository;

class ProductController extends ResourceController
{
    /**
     * @var Product|null
     */
    protected $resource;

    /**
     * @var ProductDevice[]|null
     */
    protected $oldProductDevices;

    /**
     * @var ProductObservation[]|null
     */
    protected $oldProductObservations;

    /**
     * @var ProductVariant[]|null
     */
    protected $oldProductVariants;

    /**
     * @var ProductVariantRate[]|null
     */
    protected $oldProductVariantsRates;

    /**
     * @var ProductVariantComposed[]|null
     */
    protected $oldProductVariantsComposes;

    /**
     * @var ProductVariantComposedComplement[]|null
     */
    protected $oldProductVariantsComposesComplements;

    /**
     * @param EntityInterface|Product $resource
     * @param RequestConfiguration $configuration
     */
    protected function completeCreateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
    }

    /**
     * @param EntityInterface|Product $resource
     * @param RequestConfiguration $configuration
     *
     * @throws
     */
    protected function completeUpdateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
    }

    /**
     * @param EntityInterface|Product $resource
     * @param RequestConfiguration $configuration
     */
    protected function prepareEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        // PRODUCT DEVICE
        $this->oldProductDevices = array();
        $productDevices = $resource->getProductDevice();

        foreach ($productDevices as $productDevice) {
            $this->oldProductDevices[] = $productDevice;
        }

        // PRODUCT OBSERVATION
        $this->oldProductObservations = array();
        $productObservations = $resource->getProductObservation();

        foreach ($productObservations as $productObservation) {
            $this->oldProductObservations[] = $productObservation;
        }

        // PRODUCT VARIANT
        $this->oldProductVariants = array();
        $this->oldProductVariantsRates = array();
        $this->oldProductVariantsComposes = array();
        $this->oldProductVariantsComposesComplements = array();
        $productVariants = $resource->getProductVariant();

        foreach ($productVariants as $productVariant) {
            $this->oldProductVariants[] = $productVariant;

            // PRODUCT VARIANT RATE
            $oldProductVariantsRates = $productVariant->getProductVariantRate();
            foreach ($oldProductVariantsRates as $oldProductVariantRate) {
                $this->oldProductVariantsRates[] = $oldProductVariantRate;
            }

            // PRODUCT VARIANT COMPOSED
            $oldProductVariantsComposes = $productVariant->getProductVariantComposed();
            foreach ($oldProductVariantsComposes as $oldProductVariantComposed) {
                $this->oldProductVariantsComposes[] = $oldProductVariantComposed;

                // PRODUCT VARIANT COMPOSED COMPLEMENT
                $oldProductVariantsComposesComplements = $oldProductVariantComposed->getProductVariantComposedComplement();
                foreach ($oldProductVariantsComposesComplements as $oldProductVariantComposedComplement) {
                    $this->oldProductVariantsComposesComplements[] = $oldProductVariantComposedComplement;
                }
            }
        }
    }

    /**
     * @param EntityInterface|Product $resource
     * @param RequestConfiguration $configuration
     */
    protected function prepareUpdateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $this->prepareEntity($resource, $configuration);
    }

    /**
     * @param EntityInterface|Product $resource
     * @param RequestConfiguration $configuration
     */
    protected function prepareCreateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $this->prepareEntity($resource, $configuration);
    }

    /**
     * @param EntityInterface|Product $resource
     * @param RequestConfiguration $configuration
     *
     * @throws
     */
    protected function postEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $nativeData = $configuration->getRequest()->get('ctic_product_product');
        // PRODUCT DEVICE
        $productDevices = $resource->getProductDevice();
        $oldProductDevices = $this->oldProductDevices;
        /** @var ProductVariantRepository $productVariantRepository */
        $productVariantRepository = $this->manager->getRepository(ProductVariant::class);

        /** @var ProductDevice $productDevice */
        foreach ($productDevices as $productDevice) {
            foreach ($oldProductDevices as $key => $oldProductDevice) {
                if ($productDevice->getId() == $oldProductDevice->getId()) {
                    unset($oldProductDevices[$key]);
                }
            }

            $productDevice->product = $resource;

            $this->manager->persist($productDevice);
        }

        foreach ($oldProductDevices as $oldProductDevice) {
            $this->manager->remove($oldProductDevice);
        }

        $this->manager->flush();

        // PRODUCT OBSERVATION
        $productObservations = $resource->getProductObservation();
        $oldProductObservations = $this->oldProductObservations;

        /** @var ProductObservation $productObservation */
        foreach ($productObservations as $productObservation) {
            foreach ($oldProductObservations as $key => $oldProductObservation) {
                if ($productObservation->getId() == $oldProductObservation->getId()) {
                    unset($oldProductObservations[$key]);
                }
            }

            $productObservation->product = $resource;

            $this->manager->persist($productObservation);
        }

        foreach ($oldProductObservations as $oldProductObservation) {
            $this->manager->remove($oldProductObservation);
        }

        $this->manager->flush();

        // PRODUCT VARIANT
        $productVariants = $resource->getProductVariant();
        $oldProductVariants = $this->oldProductVariants;
        $oldProductVariantsRates = $this->oldProductVariantsRates;
        $oldProductVariantsComposes = $this->oldProductVariantsComposes;
        $oldProductVariantsComposesComplements = $this->oldProductVariantsComposesComplements;

        /** @var ProductVariant $productVariant */
        foreach ($productVariants as $key => $productVariant) {
            foreach ($oldProductVariants as $key => $oldProductVariant) {
                if ($productVariant->getId() == $oldProductVariant->getId()) {
                    unset($oldProductVariants[$key]);
                }
            }

            $productVariant->product = $resource;

            $this->manager->persist($productVariant);

            $this->manager->flush();

            // PRODUCT VARIANT RATE
            $productVariantsRates = $productVariant->getProductVariantRate();
            $productVariantsRatesNative = $nativeData['productVariant'][$key]['productVariantRate'];
            // If automatize don't get native data, will get manual.
            if (empty($productVariantsRates) ||
                (is_array($productVariantsRatesNative) && count($productVariantsRates) != count($productVariantsRatesNative))
            ) {
                $productVariantsRates = array();

                foreach ($productVariantsRatesNative as $productVariantRateNative) {
                    $productVariantRateCommand = new ProductVariantRateCommand();
                    $productVariantRateCommand->pvp = (empty($productVariantRateNative['pvp']))? 0 : $productVariantRateNative['pvp'];
                    $productVariantRateCommand->commission = (empty($productVariantRateNative['commission']))? 0 : $productVariantRateNative['commission'];
                    $productVariantRateCommand->rate = (empty($productVariantRateNative['rate']))? null : $productVariantRateNative['rate'];

                    $productVariantRate = CreateProductVariantRate::create($productVariantRateCommand);
                    $productVariantsRates[] = $productVariantRate;
                }
            }

            /** @var ProductVariantRate $productVariantRate */
            foreach ($productVariantsRates as $productVariantRate) {
                foreach ($oldProductVariantsRates as $key => $oldProductVariantRate) {
                    if ($productVariantRate->getId() == $oldProductVariantRate->getId()) {
                        unset($oldProductVariantsRates[$key]);
                    }
                }

                $productVariantRate->setProductVariant($productVariant);

                $this->manager->persist($productVariantRate);
            }

            // PRODUCT VARIANT COMPOSED
            $productVariantsComposes = $productVariant->getProductVariantComposed();
            $productVariantsComposedNative = $nativeData['productVariant'][$key]['productVariantComposed'];
            // If automatize don't get native data, will get manual.
            if (empty($productVariantsComposes) ||
                (is_array($productVariantsComposedNative) && count($productVariantsComposes) != count($productVariantsComposedNative))
            ) {
                $productVariantsComposes = array();

                foreach ($productVariantsComposedNative as $productVariantComposedNative) {
                    $productVariantComposedCommand = new ProductVariantComposedCommand();
                    $productVariantComposedCommand->name = (empty($productVariantComposedNative['name']))? '' : $productVariantComposedNative['name'];
                    $productVariantComposedCommand->productVariantComposedComplement = (empty($productVariantComposedNative['productVariantComposedComplement']))? array() : $productVariantComposedNative['productVariantComposedComplement'];

                    $productVariantComposed = CreateProductVariantComposed::create($productVariantComposedCommand);
                    $productVariantsComposes[] = $productVariantComposed;
                }
            }

            /** @var ProductVariantComposed $productVariantComposed */
            foreach ($productVariantsComposes as $zKey => $productVariantComposed) {
                foreach ($oldProductVariantsComposes as $key => $oldProductVariantComposed) {
                    if ($productVariantComposed->getId() == $oldProductVariantComposed->getId()) {
                        unset($oldProductVariantsComposes[$key]);
                    }
                }

                $productVariantComposed->setProductVariant($productVariant);

                $this->manager->persist($productVariantComposed);

                $this->manager->flush();

                // PRODUCT VARIANT COMPOSED COMPLEMENT
                $productVariantsComposesComplements = $productVariantComposed->getProductVariantComposedComplement();
                $productVariantsComposedComplementsNative = $nativeData['productVariant'][$key]['productVariantComposed'][$zKey]['productVariantComposedComplement'];
                // If automatize don't get native data, will get manual.
                if (empty($productVariantsComposesComplements) ||
                    (is_array($productVariantsComposedComplementsNative) && count($productVariantsComposesComplements) != count($productVariantsComposedComplementsNative))
                ) {
                    $productVariantsComposesComplements = array();

                    foreach ($productVariantsComposedComplementsNative as $productVariantComposedComplementNative) {
                        $productVariantComposedComplementCommand = new ProductVariantComposedComplementCommand();
                        $productVariantComposedComplementCommand->productVariant = (empty($productVariantComposedComplementNative['productVariant']))? null : $productVariantRepository->find($productVariantComposedComplementNative['productVariant']);

                        $productVariantComposedComplement = CreateProductVariantComposedComplement::create($productVariantComposedComplementCommand);
                        $productVariantsComposesComplements[] = $productVariantComposedComplement;
                    }
                }

                /** @var ProductVariantComposedComplement $productVariantComposedComplement */
                foreach ($productVariantsComposesComplements as $productVariantComposedComplement) {
                    foreach ($oldProductVariantsComposesComplements as $key => $oldProductVariantComposedComplement) {
                        if ($productVariantComposedComplement->getId() == $oldProductVariantComposedComplement->getId()) {
                            unset($oldProductVariantsComposesComplements[$key]);
                        }
                    }

                    $productVariantComposedComplement->setProductVariantComposed($productVariantComposed);

                    $this->manager->persist($productVariantComposedComplement);
                }
            }
        }

        foreach ($oldProductVariants as $oldProductVariant) {
            $this->manager->remove($oldProductVariant);
        }

        foreach ($oldProductVariantsRates as $oldProductVariantRate) {
            $this->manager->remove($oldProductVariantRate);
        }

        foreach ($oldProductVariantsComposes as $oldProductVariantComposed) {
            $this->manager->remove($oldProductVariantComposed);
        }

        foreach ($oldProductVariantsComposesComplements as $oldProductVariantComposedComplement) {
            $this->manager->remove($oldProductVariantComposedComplement);
        }

        $this->manager->flush();
    }

    /**
     * @param EntityInterface|Product $resource
     * @param RequestConfiguration $configuration
     */
    protected function postCreateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $this->postEntity($resource, $configuration);
    }

    /**
     * @param EntityInterface|Product $resource
     * @param RequestConfiguration $configuration
     */
    protected function postUpdateEntity(EntityInterface $resource, RequestConfiguration $configuration): void
    {
        $this->postEntity($resource, $configuration);
    }
}