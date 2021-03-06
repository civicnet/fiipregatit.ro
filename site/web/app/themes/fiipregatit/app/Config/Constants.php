<?php

namespace App\Config;

final class Constants {
    private function __construct() {}

    const POST_TYPE_GUIDE = 'ghid';
    const POST_TYPE_GUIDE_SECTION = 'sectiune_ghid';
    const POST_TYPE_CAMPAIGN = 'campanie';
    const POST_TYPE_LINK = 'link_util';

    const HOMEPAGE_CAMPAIGNS_COUNT = 4;
    const HOMEPAGE_GUIDE_COUNT = 7;

    const LINK_COUNT = 12;

    const GUIDE_METABOX_GALLERY = 'fii_pregatit_galerie';
    const CAMPAIGN_METABOX_ATTACHMENTS = 'fii_pregatit_atasamente';
    const CAMPAIGN_METABOX_VIDEO_GROUP = 'fii_pregatit_video_list';
    const ABOUT_PAGE_METABOX_PARTNERS = 'fii_pregatit_parteneri';
    const ABOUT_PAGE_METABOX_PARTNER_DESC = 'fii_pregatit_descriere_parteneri';

    const PAGE_PERSONAL_PLAN = 'plan-personal';
    const PAGE_FIRST_AID = 'prim-ajutor';
    const PAGE_ABOUT = 'despre';

    const PAGE_GHIDURI = 'ghiduri';
    const PAGE_CAMPANII = 'campanii';
  }
