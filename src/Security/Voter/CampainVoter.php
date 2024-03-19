<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Security;
use App\Entity\Campain;


class CampainVoter extends Voter
{
    public const CAMPAIN_POST = 'CAMPAIN_POST';


    private $security = null;
    private $loggedinUserRoles = [];

    public function __construct(Security $security)
    {
        $this->security = $security;

    }

    protected function supports(string $attribute, mixed $subject): bool
    {        
        return in_array($attribute, [self::CAMPAIN_POST])
        && $subject instanceof \App\Entity\Campain;

    }   

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        /** @var Campain $campaign */
        $campaign = $subject;
        $this->loggedinUserRoles = ['ROLE_ADMIN', 'ROLE_USER'];

        switch ($attribute) {
            case self::CAMPAIN_POST:
                return $this->canPost($campaign);
            default:
                return false;
        }

        return false;
    }

    private function canPost(Campain $post): bool
    {

        if (!in_array('ROLE_SUPER', $this->loggedinUserRoles)) {
            return true;
        }

    }
}
