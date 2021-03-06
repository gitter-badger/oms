<?php
namespace phpOMS\System;

/**
 * Database type enum.
 *
 * Database types that are supported by the application
 *
 * PHP Version 7.0
 *
 * @category   Framework
 * @package    phpOMS\DataStorage\Database
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
abstract class MimeType extends \phpOMS\Datatypes\Enum
{
    const M_3DML = 'text/vnd.in3d.3dml';

    const M_3DS = 'image/x-3ds';

    const M_3G2 = 'video/3gpp2';

    const M_3GP = 'video/3gpp';

    const M_7Z = 'application/x-7z-compressed';

    const M_AAB = 'application/x-authorware-bin';

    const M_AAC = 'audio/x-aac';

    const M_AAM = 'application/x-authorware-map';

    const M_AAS = 'application/x-authorware-seg';

    const M_ABW = 'application/x-abiword';

    const M_AC = 'application/pkix-attr-cert';

    const M_ACC = 'application/vnd.americandynamics.acc';

    const M_ACE = 'application/x-ace-compressed';

    const M_ACU = 'application/vnd.acucobol';

    const M_ACUTC = 'application/vnd.acucorp';

    const M_ADP = 'audio/adpcm';

    const M_AEP = 'application/vnd.audiograph';

    const M_AFM = 'application/x-font-type1';

    const M_AFP = 'application/vnd.ibm.modcap';

    const M_AHEAD = 'application/vnd.ahead.space';

    const M_AI = 'application/postscript';

    const M_AIF = 'audio/x-aiff';

    const M_AIFC = 'audio/x-aiff';

    const M_AIFF = 'audio/x-aiff';

    const M_AIR = 'application/vnd.adobe.air-application-installer-package+zip';

    const M_AIT = 'application/vnd.dvb.ait';

    const M_AMI = 'application/vnd.amiga.ami';

    const M_APK = 'application/vnd.android.package-archive';

    const M_APPCACHE = 'text/cache-manifest';

    const M_APR = 'application/vnd.lotus-approach';

    const M_APS = 'application/postscript';

    const M_ARC = 'application/x-freearc';

    const M_ASC = 'application/pgp-signature';

    const M_ASF = 'video/x-ms-asf';

    const M_ASM = 'text/x-asm';

    const M_ASO = 'application/vnd.accpac.simply.aso';

    const M_ASX = 'video/x-ms-asf';

    const M_ATC = 'application/vnd.acucorp';

    const M_ATOM = 'application/atom+xml';

    const M_ATOMCAT = 'application/atomcat+xml';

    const M_ATOMSVC = 'application/atomsvc+xml';

    const M_ATX = 'application/vnd.antix.game-component';

    const M_AU = 'audio/basic';

    const M_AVI = 'video/x-msvideo';

    const M_AW = 'application/applixware';

    const M_AZF = 'application/vnd.airzip.filesecure.azf';

    const M_AZS = 'application/vnd.airzip.filesecure.azs';

    const M_AZW = 'application/vnd.amazon.ebook';

    const M_BAT = 'application/x-msdownload';

    const M_BCPIO = 'application/x-bcpio';

    const M_BDF = 'application/x-font-bdf';

    const M_BDM = 'application/vnd.syncml.dm+wbxml';

    const M_BED = 'application/vnd.realvnc.bed';

    const M_BH2 = 'application/vnd.fujitsu.oasysprs';

    const M_BIN = 'application/octet-stream';

    const M_BLB = 'application/x-blorb';

    const M_BLORB = 'application/x-blorb';

    const M_BMI = 'application/vnd.bmi';

    const M_BMP = 'image/bmp';

    const M_BOOK = 'application/vnd.framemaker';

    const M_BOX = 'application/vnd.previewsystems.box';

    const M_BOZ = 'application/x-bzip2';

    const M_BPK = 'application/octet-stream';

    const M_BTIF = 'image/prs.btif';

    const M_BZ = 'application/x-bzip';

    const M_BZ2 = 'application/x-bzip2';

    const M_C = 'text/x-c';

    const M_C11AMC = 'application/vnd.cluetrust.cartomobile-config';

    const M_C11AMZ = 'application/vnd.cluetrust.cartomobile-config-pkg';

    const M_C4D = 'application/vnd.clonk.c4group';

    const M_C4F = 'application/vnd.clonk.c4group';

    const M_C4G = 'application/vnd.clonk.c4group';

    const M_C4P = 'application/vnd.clonk.c4group';

    const M_C4U = 'application/vnd.clonk.c4group';

    const M_CAB = 'application/vnd.ms-cab-compressed';

    const M_CAF = 'audio/x-caf';

    const M_CAP = 'application/vnd.tcpdump.pcap';

    const M_CAR = 'application/vnd.curl.car';

    const M_CAT = 'application/vnd.ms-pki.seccat';

    const M_CB7 = 'application/x-cbr';

    const M_CBA = 'application/x-cbr';

    const M_CBR = 'application/x-cbr';

    const M_CBT = 'application/x-cbr';

    const M_CBZ = 'application/x-cbr';

    const M_CC = 'text/x-c';

    const M_CCT = 'application/x-director';

    const M_CCXML = 'application/ccxml+xml';

    const M_CDBCMSG = 'application/vnd.contact.cmsg';

    const M_CDF = 'application/x-netcdf';

    const M_CDKEY = 'application/vnd.mediastation.cdkey';

    const M_CDMIA = 'application/cdmi-capability';

    const M_CDMIC = 'application/cdmi-container';

    const M_CDMID = 'application/cdmi-domain';

    const M_CDMIO = 'application/cdmi-object';

    const M_CDMIQ = 'application/cdmi-queue';

    const M_CDX = 'chemical/x-cdx';

    const M_CDXML = 'application/vnd.chemdraw+xml';

    const M_CDY = 'application/vnd.cinderella';

    const M_CER = 'application/pkix-cert';

    const M_CFS = 'application/x-cfs-compressed';

    const M_CGM = 'image/cgm';

    const M_CHAT = 'application/x-chat';

    const M_CHM = 'application/vnd.ms-htmlhelp';

    const M_CHRT = 'application/vnd.kde.kchart';

    const M_CIF = 'chemical/x-cif';

    const M_CII = 'application/vnd.anser-web-certificate-issue-initiation';

    const M_CIL = 'application/vnd.ms-artgalry';

    const M_CLA = 'application/vnd.claymore';

    const M_CLASS = 'application/java-vm';

    const M_CLKK = 'application/vnd.crick.clicker.keyboard';

    const M_CLKP = 'application/vnd.crick.clicker.palette';

    const M_CLKT = 'application/vnd.crick.clicker.template';

    const M_CLKW = 'application/vnd.crick.clicker.wordbank';

    const M_CLKX = 'application/vnd.crick.clicker';

    const M_CLP = 'application/x-msclip';

    const M_CMC = 'application/vnd.cosmocaller';

    const M_CMDF = 'chemical/x-cmdf';

    const M_CML = 'chemical/x-cml';

    const M_CMP = 'application/vnd.yellowriver-custom-menu';

    const M_CMX = 'image/x-cmx';

    const M_COD = 'application/vnd.rim.cod';

    const M_COM = 'application/x-msdownload';

    const M_CONF = 'text/plain';

    const M_CPIO = 'application/x-cpio';

    const M_CPP = 'text/x-c';

    const M_CPT = 'application/mac-compactpro';

    const M_CRD = 'application/x-mscardfile';

    const M_CRL = 'application/pkix-crl';

    const M_CRT = 'application/x-x509-ca-cert';

    const M_CSH = 'application/x-csh';

    const M_CSML = 'chemical/x-csml';

    const M_CSP = 'application/vnd.commonspace';

    const M_CSS = 'text/css';

    const M_CST = 'application/x-director';

    const M_CSV = 'text/csv';

    const M_CU = 'application/cu-seeme';

    const M_CURL = 'text/vnd.curl';

    const M_CWW = 'application/prs.cww';

    const M_CXT = 'application/x-director';

    const M_CXX = 'text/x-c';

    const M_DAE = 'model/vnd.collada+xml';

    const M_DAF = 'application/vnd.mobius.daf';

    const M_DART = 'application/vnd.dart';

    const M_DATALESS = 'application/vnd.fdsn.seed';

    const M_DAVMOUNT = 'application/davmount+xml';

    const M_DBK = 'application/docbook+xml';

    const M_DCR = 'application/x-director';

    const M_DCURL = 'text/vnd.curl.dcurl';

    const M_DD2 = 'application/vnd.oma.dd2+xml';

    const M_DDD = 'application/vnd.fujixerox.ddd';

    const M_DEB = 'application/x-debian-package';

    const M_DEF = 'text/plain';

    const M_DEPLOY = 'application/octet-stream';

    const M_DER = 'application/x-x509-ca-cert';

    const M_DFAC = 'application/vnd.dreamfactory';

    const M_DGC = 'application/x-dgc-compressed';

    const M_DIC = 'text/x-c';

    const M_DIR = 'application/x-director';

    const M_DIS = 'application/vnd.mobius.dis';

    const M_DIST = 'application/octet-stream';

    const M_DISTZ = 'application/octet-stream';

    const M_DJV = 'image/vnd.djvu';

    const M_DJVU = 'image/vnd.djvu';

    const M_DLL = 'application/x-msdownload';

    const M_DMG = 'application/x-apple-diskimage';

    const M_DMP = 'application/vnd.tcpdump.pcap';

    const M_DMS = 'application/octet-stream';

    const M_DNA = 'application/vnd.dna';

    const M_DOC = 'application/msword';

    const M_DOCM = 'application/vnd.ms-word.document.macroenabled.12';

    const M_DOCX = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';

    const M_DOT = 'application/msword';

    const M_DOTM = 'application/vnd.ms-word.template.macroenabled.12';

    const M_DOTX = 'application/vnd.openxmlformats-officedocument.wordprocessingml.template';

    const M_DP = 'application/vnd.osgi.dp';

    const M_DPG = 'application/vnd.dpgraph';

    const M_DRA = 'audio/vnd.dra';

    const M_DSC = 'text/prs.lines.tag';

    const M_DSSC = 'application/dssc+der';

    const M_DTB = 'application/x-dtbook+xml';

    const M_DTD = 'application/xml-dtd';

    const M_DTS = 'audio/vnd.dts';

    const M_DTSHD = 'audio/vnd.dts.hd';

    const M_DUMP = 'application/octet-stream';

    const M_DVB = 'video/vnd.dvb.file';

    const M_DVI = 'application/x-dvi';

    const M_DWF = 'model/vnd.dwf';

    const M_DWG = 'image/vnd.dwg';

    const M_DXF = 'image/vnd.dxf';

    const M_DXP = 'application/vnd.spotfire.dxp';

    const M_DXR = 'application/x-director';

    const M_ECELP4800 = 'audio/vnd.nuera.ecelp4800';

    const M_ECELP7470 = 'audio/vnd.nuera.ecelp7470';

    const M_ECELP9600 = 'audio/vnd.nuera.ecelp9600';

    const M_ECMA = 'application/ecmascript';

    const M_EDM = 'application/vnd.novadigm.edm';

    const M_EDX = 'application/vnd.novadigm.edx';

    const M_EFIF = 'application/vnd.picsel';

    const M_EI6 = 'application/vnd.pg.osasli';

    const M_ELC = 'application/octet-stream';

    const M_EMF = 'application/x-msmetafile';

    const M_EML = 'message/rfc822';

    const M_EMMA = 'application/emma+xml';

    const M_EMZ = 'application/x-msmetafile';

    const M_EOL = 'audio/vnd.digital-winds';

    const M_EOT = 'application/vnd.ms-fontobject';

    const M_EPS = 'application/postscript';

    const M_EPUB = 'application/epub+zip';

    const M_ES3 = 'application/vnd.eszigno3+xml';

    const M_ESA = 'application/vnd.osgi.subsystem';

    const M_ESF = 'application/vnd.epson.esf';

    const M_ET3 = 'application/vnd.eszigno3+xml';

    const M_ETX = 'text/x-setext';

    const M_EVA = 'application/x-eva';

    const M_EVY = 'application/x-envoy';

    const M_EXE = 'application/x-msdownload';

    const M_EXI = 'application/exi';

    const M_EXT = 'application/vnd.novadigm.ext';

    const M_EZ = 'application/andrew-inset';

    const M_EZ2 = 'application/vnd.ezpix-album';

    const M_EZ3 = 'application/vnd.ezpix-package';

    const M_F = 'text/x-fortran';

    const M_F4V = 'video/x-f4v';

    const M_F77 = 'text/x-fortran';

    const M_F90 = 'text/x-fortran';

    const M_FBS = 'image/vnd.fastbidsheet';

    const M_FCDT = 'application/vnd.adobe.formscentral.fcdt';

    const M_FCS = 'application/vnd.isac.fcs';

    const M_FDF = 'application/vnd.fdf';

    const M_FE_LAUNCH = 'application/vnd.denovo.fcselayout-link';

    const M_FG5 = 'application/vnd.fujitsu.oasysgp';

    const M_FGD = 'application/x-director';

    const M_FH = 'image/x-freehand';

    const M_FH4 = 'image/x-freehand';

    const M_FH5 = 'image/x-freehand';

    const M_FH7 = 'image/x-freehand';

    const M_FHC = 'image/x-freehand';

    const M_FIG = 'application/x-xfig';

    const M_FLAC = 'audio/x-flac';

    const M_FLI = 'video/x-fli';

    const M_FLO = 'application/vnd.micrografx.flo';

    const M_FLV = 'video/x-flv';

    const M_FLW = 'application/vnd.kde.kivio';

    const M_FLX = 'text/vnd.fmi.flexstor';

    const M_FLY = 'text/vnd.fly';

    const M_FM = 'application/vnd.framemaker';

    const M_FNC = 'application/vnd.frogans.fnc';

    const M_FOR = 'text/x-fortran';

    const M_FPX = 'image/vnd.fpx';

    const M_FRAME = 'application/vnd.framemaker';

    const M_FSC = 'application/vnd.fsc.weblaunch';

    const M_FST = 'image/vnd.fst';

    const M_FTC = 'application/vnd.fluxtime.clip';

    const M_FTI = 'application/vnd.anser-web-funds-transfer-initiation';

    const M_FVT = 'video/vnd.fvt';

    const M_FXP = 'application/vnd.adobe.fxp';

    const M_FXPL = 'application/vnd.adobe.fxp';

    const M_FZS = 'application/vnd.fuzzysheet';

    const M_G2W = 'application/vnd.geoplan';

    const M_G3 = 'image/g3fax';

    const M_G3W = 'application/vnd.geospace';

    const M_GAC = 'application/vnd.groove-account';

    const M_GAM = 'application/x-tads';

    const M_GBR = 'application/rpki-ghostbusters';

    const M_GCA = 'application/x-gca-compressed';

    const M_GDL = 'model/vnd.gdl';

    const M_GEO = 'application/vnd.dynageo';

    const M_GEX = 'application/vnd.geometry-explorer';

    const M_GGB = 'application/vnd.geogebra.file';

    const M_GGT = 'application/vnd.geogebra.tool';

    const M_GHF = 'application/vnd.groove-help';

    const M_GIF = 'image/gif';

    const M_GIM = 'application/vnd.groove-identity-message';

    const M_GML = 'application/gml+xml';

    const M_GMX = 'application/vnd.gmx';

    const M_GNUMERIC = 'application/x-gnumeric';

    const M_GPH = 'application/vnd.flographit';

    const M_GPX = 'application/gpx+xml';

    const M_GQF = 'application/vnd.grafeq';

    const M_GQS = 'application/vnd.grafeq';

    const M_GRAM = 'application/srgs';

    const M_GRAMPS = 'application/x-gramps-xml';

    const M_GRE = 'application/vnd.geometry-explorer';

    const M_GRV = 'application/vnd.groove-injector';

    const M_GRXML = 'application/srgs+xml';

    const M_GSF = 'application/x-font-ghostscript';

    const M_GTAR = 'application/x-gtar';

    const M_GTM = 'application/vnd.groove-tool-message';

    const M_GTW = 'model/vnd.gtw';

    const M_GV = 'text/vnd.graphviz';

    const M_GXF = 'application/gxf';

    const M_GXT = 'application/vnd.geonext';

    const M_GZ = 'application/x-gzip';

    const M_H = 'text/x-c';

    const M_H261 = 'video/h261';

    const M_H263 = 'video/h263';

    const M_H264 = 'video/h264';

    const M_HAL = 'application/vnd.hal+xml';

    const M_HBCI = 'application/vnd.hbci';

    const M_HDF = 'application/x-hdf';

    const M_HH = 'text/x-c';

    const M_HLP = 'application/winhlp';

    const M_HPGL = 'application/vnd.hp-hpgl';

    const M_HPID = 'application/vnd.hp-hpid';

    const M_HPS = 'application/vnd.hp-hps';

    const M_HQX = 'application/mac-binhex40';

    const M_HTKE = 'application/vnd.kenameaapp';

    const M_HTM = 'text/html';

    const M_HTML = 'text/html';

    const M_HVD = 'application/vnd.yamaha.hv-dic';

    const M_HVP = 'application/vnd.yamaha.hv-voice';

    const M_HVS = 'application/vnd.yamaha.hv-script';

    const M_I2G = 'application/vnd.intergeo';

    const M_ICC = 'application/vnd.iccprofile';

    const M_ICE = 'x-conference/x-cooltalk';

    const M_ICM = 'application/vnd.iccprofile';

    const M_ICO = 'image/x-icon';

    const M_ICS = 'text/calendar';

    const M_IEF = 'image/ief';

    const M_IFB = 'text/calendar';

    const M_IFM = 'application/vnd.shana.informed.formdata';

    const M_IGES = 'model/iges';

    const M_IGL = 'application/vnd.igloader';

    const M_IGM = 'application/vnd.insors.igm';

    const M_IGS = 'model/iges';

    const M_IGX = 'application/vnd.micrografx.igx';

    const M_IIF = 'application/vnd.shana.informed.interchange';

    const M_IMP = 'application/vnd.accpac.simply.imp';

    const M_IMS = 'application/vnd.ms-ims';

    const M_IN = 'text/plain';

    const M_INK = 'application/inkml+xml';

    const M_INKML = 'application/inkml+xml';

    const M_INSTALL = 'application/x-install-instructions';

    const M_IOTA = 'application/vnd.astraea-software.iota';

    const M_IPFIX = 'application/ipfix';

    const M_IPK = 'application/vnd.shana.informed.package';

    const M_IRM = 'application/vnd.ibm.rights-management';

    const M_IRP = 'application/vnd.irepository.package+xml';

    const M_ISO = 'application/x-iso9660-image';

    const M_ITP = 'application/vnd.shana.informed.formtemplate';

    const M_IVP = 'application/vnd.immervision-ivp';

    const M_IVU = 'application/vnd.immervision-ivu';

    const M_JAD = 'text/vnd.sun.j2me.app-descriptor';

    const M_JAM = 'application/vnd.jam';

    const M_JAR = 'application/java-archive';

    const M_JAVA = 'text/x-java-source';

    const M_JISP = 'application/vnd.jisp';

    const M_JLT = 'application/vnd.hp-jlyt';

    const M_JNLP = 'application/x-java-jnlp-file';

    const M_JODA = 'application/vnd.joost.joda-archive';

    const M_JPE = 'image/jpeg';

    const M_JPEG = 'image/jpeg';

    const M_JPG = 'image/jpeg';

    const M_JPGM = 'video/jpm';

    const M_JPGV = 'video/jpeg';

    const M_JPM = 'video/jpm';

    const M_JS = 'application/javascript';

    const M_JSON = 'application/json';

    const M_JSONML = 'application/jsonml+json';

    const M_KAR = 'audio/midi';

    const M_KARBON = 'application/vnd.kde.karbon';

    const M_KFO = 'application/vnd.kde.kformula';

    const M_KIA = 'application/vnd.kidspiration';

    const M_KML = 'application/vnd.google-earth.kml+xml';

    const M_KMZ = 'application/vnd.google-earth.kmz';

    const M_KNE = 'application/vnd.kinar';

    const M_KNP = 'application/vnd.kinar';

    const M_KON = 'application/vnd.kde.kontour';

    const M_KPR = 'application/vnd.kde.kpresenter';

    const M_KPT = 'application/vnd.kde.kpresenter';

    const M_KPXX = 'application/vnd.ds-keypoint';

    const M_KSP = 'application/vnd.kde.kspread';

    const M_KTR = 'application/vnd.kahootz';

    const M_KTX = 'image/ktx';

    const M_KTZ = 'application/vnd.kahootz';

    const M_KWD = 'application/vnd.kde.kword';

    const M_KWT = 'application/vnd.kde.kword';

    const M_LASXML = 'application/vnd.las.las+xml';

    const M_LATEX = 'application/x-latex';

    const M_LBD = 'application/vnd.llamagraphics.life-balance.desktop';

    const M_LBE = 'application/vnd.llamagraphics.life-balance.exchange+xml';

    const M_LES = 'application/vnd.hhe.lesson-player';

    const M_LHA = 'application/x-lzh-compressed';

    const M_LINK66 = 'application/vnd.route66.link66+xml';

    const M_LIST = 'text/plain';

    const M_LIST3820 = 'application/vnd.ibm.modcap';

    const M_LISTAFP = 'application/vnd.ibm.modcap';

    const M_LNK = 'application/x-ms-shortcut';

    const M_LOG = 'text/plain';

    const M_LOSTXML = 'application/lost+xml';

    const M_LRF = 'application/octet-stream';

    const M_LRM = 'application/vnd.ms-lrm';

    const M_LTF = 'application/vnd.frogans.ltf';

    const M_LVP = 'audio/vnd.lucent.voice';

    const M_LWP = 'application/vnd.lotus-wordpro';

    const M_LZH = 'application/x-lzh-compressed';

    const M_M13 = 'application/x-msmediaview';

    const M_M14 = 'application/x-msmediaview';

    const M_M1V = 'video/mpeg';

    const M_M21 = 'application/mp21';

    const M_M2A = 'audio/mpeg';

    const M_M2V = 'video/mpeg';

    const M_M3A = 'audio/mpeg';

    const M_M3U = 'audio/x-mpegurl';

    const M_M3U8 = 'application/vnd.apple.mpegurl';

    const M_M4A = 'audio/mp4';

    const M_M4U = 'video/vnd.mpegurl';

    const M_M4V = 'video/x-m4v';

    const M_MA = 'application/mathematica';

    const M_MADS = 'application/mads+xml';

    const M_MAG = 'application/vnd.ecowin.chart';

    const M_MAKER = 'application/vnd.framemaker';

    const M_MAN = 'text/troff';

    const M_MAR = 'application/octet-stream';

    const M_MATHML = 'application/mathml+xml';

    const M_MB = 'application/mathematica';

    const M_MBK = 'application/vnd.mobius.mbk';

    const M_MBOX = 'application/mbox';

    const M_MC1 = 'application/vnd.medcalcdata';

    const M_MCD = 'application/vnd.mcd';

    const M_MCURL = 'text/vnd.curl.mcurl';

    const M_MDB = 'application/x-msaccess';

    const M_MDI = 'image/vnd.ms-modi';

    const M_ME = 'text/troff';

    const M_MESH = 'model/mesh';

    const M_META4 = 'application/metalink4+xml';

    const M_METALINK = 'application/metalink+xml';

    const M_METS = 'application/mets+xml';

    const M_MFM = 'application/vnd.mfmp';

    const M_MFT = 'application/rpki-manifest';

    const M_MGP = 'application/vnd.osgeo.mapguide.package';

    const M_MGZ = 'application/vnd.proteus.magazine';

    const M_MID = 'audio/midi';

    const M_MIDI = 'audio/midi';

    const M_MIE = 'application/x-mie';

    const M_MIF = 'application/vnd.mif';

    const M_MIME = 'message/rfc822';

    const M_MJ2 = 'video/mj2';

    const M_MJP2 = 'video/mj2';

    const M_MK3D = 'video/x-matroska';

    const M_MKA = 'audio/x-matroska';

    const M_MKS = 'video/x-matroska';

    const M_MKV = 'video/x-matroska';

    const M_MLP = 'application/vnd.dolby.mlp';

    const M_MMD = 'application/vnd.chipnuts.karaoke-mmd';

    const M_MMF = 'application/vnd.smaf';

    const M_MMR = 'image/vnd.fujixerox.edmics-mmr';

    const M_MNG = 'video/x-mng';

    const M_MNY = 'application/x-msmoney';

    const M_MOBI = 'application/x-mobipocket-ebook';

    const M_MODS = 'application/mods+xml';

    const M_MOV = 'video/quicktime';

    const M_MOVIE = 'video/x-sgi-movie';

    const M_MP2 = 'audio/mpeg';

    const M_MP21 = 'application/mp21';

    const M_MP2A = 'audio/mpeg';

    const M_MP3 = 'audio/mpeg';

    const M_MP4 = 'video/mp4';

    const M_MP4A = 'audio/mp4';

    const M_MP4S = 'application/mp4';

    const M_MP4V = 'video/mp4';

    const M_MPC = 'application/vnd.mophun.certificate';

    const M_MPE = 'video/mpeg';

    const M_MPEG = 'video/mpeg';

    const M_MPG = 'video/mpeg';

    const M_MPG4 = 'video/mp4';

    const M_MPGA = 'audio/mpeg';

    const M_MPKG = 'application/vnd.apple.installer+xml';

    const M_MPM = 'application/vnd.blueice.multipass';

    const M_MPN = 'application/vnd.mophun.application';

    const M_MPP = 'application/vnd.ms-project';

    const M_MPT = 'application/vnd.ms-project';

    const M_MPY = 'application/vnd.ibm.minipay';

    const M_MQY = 'application/vnd.mobius.mqy';

    const M_MRC = 'application/marc';

    const M_MRCX = 'application/marcxml+xml';

    const M_MS = 'text/troff';

    const M_MSCML = 'application/mediaservercontrol+xml';

    const M_MSEED = 'application/vnd.fdsn.mseed';

    const M_MSEQ = 'application/vnd.mseq';

    const M_MSF = 'application/vnd.epson.msf';

    const M_MSH = 'model/mesh';

    const M_MSI = 'application/x-msdownload';

    const M_MSL = 'application/vnd.mobius.msl';

    const M_MSTY = 'application/vnd.muvee.style';

    const M_MTS = 'model/vnd.mts';

    const M_MUS = 'application/vnd.musician';

    const M_MUSICXML = 'application/vnd.recordare.musicxml+xml';

    const M_MVB = 'application/x-msmediaview';

    const M_MWF = 'application/vnd.mfer';

    const M_MXF = 'application/mxf';

    const M_MXL = 'application/vnd.recordare.musicxml';

    const M_MXML = 'application/xv+xml';

    const M_MXS = 'application/vnd.triscape.mxs';

    const M_MXU = 'video/vnd.mpegurl';

    const M_N_GAGE = 'application/vnd.nokia.n-gage.symbian.install';

    const M_N3 = 'text/n3';

    const M_NB = 'application/mathematica';

    const M_NBP = 'application/vnd.wolfram.player';

    const M_NC = 'application/x-netcdf';

    const M_NCX = 'application/x-dtbncx+xml';

    const M_NFO = 'text/x-nfo';

    const M_NGDAT = 'application/vnd.nokia.n-gage.data';

    const M_NITF = 'application/vnd.nitf';

    const M_NLU = 'application/vnd.neurolanguage.nlu';

    const M_NML = 'application/vnd.enliven';

    const M_NND = 'application/vnd.noblenet-directory';

    const M_NNS = 'application/vnd.noblenet-sealer';

    const M_NNW = 'application/vnd.noblenet-web';

    const M_NPX = 'image/vnd.net-fpx';

    const M_NSC = 'application/x-conference';

    const M_NSF = 'application/vnd.lotus-notes';

    const M_NTF = 'application/vnd.nitf';

    const M_NZB = 'application/x-nzb';

    const M_OA2 = 'application/vnd.fujitsu.oasys2';

    const M_OA3 = 'application/vnd.fujitsu.oasys3';

    const M_OAS = 'application/vnd.fujitsu.oasys';

    const M_OBD = 'application/x-msbinder';

    const M_OBJ = 'application/x-tgif';

    const M_ODA = 'application/oda';

    const M_ODB = 'application/vnd.oasis.opendocument.database';

    const M_ODC = 'application/vnd.oasis.opendocument.chart';

    const M_ODF = 'application/vnd.oasis.opendocument.formula';

    const M_ODFT = 'application/vnd.oasis.opendocument.formula-template';

    const M_ODG = 'application/vnd.oasis.opendocument.graphics';

    const M_ODI = 'application/vnd.oasis.opendocument.image';

    const M_ODM = 'application/vnd.oasis.opendocument.text-master';

    const M_ODP = 'application/vnd.oasis.opendocument.presentation';

    const M_ODS = 'application/vnd.oasis.opendocument.spreadsheet';

    const M_ODT = 'application/vnd.oasis.opendocument.text';

    const M_OGA = 'audio/ogg';

    const M_OGG = 'audio/ogg';

    const M_OGV = 'video/ogg';

    const M_OGX = 'application/ogg';

    const M_OMDOC = 'application/omdoc+xml';

    const M_ONEPKG = 'application/onenote';

    const M_ONETMP = 'application/onenote';

    const M_ONETOC = 'application/onenote';

    const M_ONETOC2 = 'application/onenote';

    const M_OPF = 'application/oebps-package+xml';

    const M_OPML = 'text/x-opml';

    const M_OPRC = 'application/vnd.palm';

    const M_ORG = 'application/vnd.lotus-organizer';

    const M_OSF = 'application/vnd.yamaha.openscoreformat';

    const M_OSFPVG = 'application/vnd.yamaha.openscoreformat.osfpvg+xml';

    const M_OTC = 'application/vnd.oasis.opendocument.chart-template';

    const M_OTF = 'application/x-font-otf';

    const M_OTG = 'application/vnd.oasis.opendocument.graphics-template';

    const M_OTH = 'application/vnd.oasis.opendocument.text-web';

    const M_OTI = 'application/vnd.oasis.opendocument.image-template';

    const M_OTP = 'application/vnd.oasis.opendocument.presentation-template';

    const M_OTS = 'application/vnd.oasis.opendocument.spreadsheet-template';

    const M_OTT = 'application/vnd.oasis.opendocument.text-template';

    const M_OXPS = 'application/oxps';

    const M_OXT = 'application/vnd.openofficeorg.extension';

    const M_P = 'text/x-pascal';

    const M_P10 = 'application/pkcs10';

    const M_P12 = 'application/x-pkcs12';

    const M_P7B = 'application/x-pkcs7-certificates';

    const M_P7C = 'application/pkcs7-mime';

    const M_P7M = 'application/pkcs7-mime';

    const M_P7R = 'application/x-pkcs7-certreqresp';

    const M_P7S = 'application/pkcs7-signature';

    const M_P8 = 'application/pkcs8';

    const M_PAS = 'text/x-pascal';

    const M_PAW = 'application/vnd.pawaafile';

    const M_PBD = 'application/vnd.powerbuilder6';

    const M_PBM = 'image/x-portable-bitmap';

    const M_PCAP = 'application/vnd.tcpdump.pcap';

    const M_PCF = 'application/x-font-pcf';

    const M_PCL = 'application/vnd.hp-pcl';

    const M_PCLXL = 'application/vnd.hp-pclxl';

    const M_PCT = 'image/x-pict';

    const M_PCURL = 'application/vnd.curl.pcurl';

    const M_PCX = 'image/x-pcx';

    const M_PDB = 'application/vnd.palm';

    const M_PDF = 'application/pdf';

    const M_PFA = 'application/x-font-type1';

    const M_PFB = 'application/x-font-type1';

    const M_PFM = 'application/x-font-type1';

    const M_PFR = 'application/font-tdpfr';

    const M_PFX = 'application/x-pkcs12';

    const M_PGM = 'image/x-portable-graymap';

    const M_PGN = 'application/x-chess-pgn';

    const M_PGP = 'application/pgp-encrypted';

    const M_PHP = 'application/x-php';

    const M_PHP3 = 'application/x-php';

    const M_PHP4 = 'application/x-php';

    const M_PHP5 = 'application/x-php';

    const M_PIC = 'image/x-pict';

    const M_PKG = 'application/octet-stream';

    const M_PKI = 'application/pkixcmp';

    const M_PKIPATH = 'application/pkix-pkipath';

    const M_PLB = 'application/vnd.3gpp.pic-bw-large';

    const M_PLC = 'application/vnd.mobius.plc';

    const M_PLF = 'application/vnd.pocketlearn';

    const M_PLS = 'application/pls+xml';

    const M_PML = 'application/vnd.ctc-posml';

    const M_PNG = 'image/png';

    const M_PNM = 'image/x-portable-anymap';

    const M_PORTPKG = 'application/vnd.macports.portpkg';

    const M_POT = 'application/vnd.ms-powerpoint';

    const M_POTM = 'application/vnd.ms-powerpoint.template.macroenabled.12';

    const M_POTX = 'application/vnd.openxmlformats-officedocument.presentationml.template';

    const M_PPAM = 'application/vnd.ms-powerpoint.addin.macroenabled.12';

    const M_PPD = 'application/vnd.cups-ppd';

    const M_PPM = 'image/x-portable-pixmap';

    const M_PPS = 'application/vnd.ms-powerpoint';

    const M_PPSM = 'application/vnd.ms-powerpoint.slideshow.macroenabled.12';

    const M_PPSX = 'application/vnd.openxmlformats-officedocument.presentationml.slideshow';

    const M_PPT = 'application/vnd.ms-powerpoint';

    const M_PPTM = 'application/vnd.ms-powerpoint.presentation.macroenabled.12';

    const M_PPTX = 'application/vnd.openxmlformats-officedocument.presentationml.presentation';

    const M_PQA = 'application/vnd.palm';

    const M_PRC = 'application/x-mobipocket-ebook';

    const M_PRE = 'application/vnd.lotus-freelance';

    const M_PRF = 'application/pics-rules';

    const M_PS = 'application/postscript';

    const M_PSB = 'application/vnd.3gpp.pic-bw-small';

    const M_PSD = 'image/vnd.adobe.photoshop';

    const M_PSF = 'application/x-font-linux-psf';

    const M_PSKCXML = 'application/pskc+xml';

    const M_PTID = 'application/vnd.pvi.ptid1';

    const M_PUB = 'application/x-mspublisher';

    const M_PVB = 'application/vnd.3gpp.pic-bw-var';

    const M_PWN = 'application/vnd.3m.post-it-notes';

    const M_PYA = 'audio/vnd.ms-playready.media.pya';

    const M_PYV = 'video/vnd.ms-playready.media.pyv';

    const M_QAM = 'application/vnd.epson.quickanime';

    const M_QBO = 'application/vnd.intu.qbo';

    const M_QFX = 'application/vnd.intu.qfx';

    const M_QPS = 'application/vnd.publishare-delta-tree';

    const M_QT = 'video/quicktime';

    const M_QWD = 'application/vnd.quark.quarkxpress';

    const M_QWT = 'application/vnd.quark.quarkxpress';

    const M_QXB = 'application/vnd.quark.quarkxpress';

    const M_QXD = 'application/vnd.quark.quarkxpress';

    const M_QXL = 'application/vnd.quark.quarkxpress';

    const M_QXT = 'application/vnd.quark.quarkxpress';

    const M_RA = 'audio/x-pn-realaudio';

    const M_RAM = 'audio/x-pn-realaudio';

    const M_RAR = 'application/x-rar-compressed';

    const M_RAS = 'image/x-cmu-raster';

    const M_RCPROFILE = 'application/vnd.ipunplugged.rcprofile';

    const M_RDF = 'application/rdf+xml';

    const M_RDZ = 'application/vnd.data-vision.rdz';

    const M_REP = 'application/vnd.businessobjects';

    const M_RES = 'application/x-dtbresource+xml';

    const M_RGB = 'image/x-rgb';

    const M_RIF = 'application/reginfo+xml';

    const M_RIP = 'audio/vnd.rip';

    const M_RIS = 'application/x-research-info-systems';

    const M_RL = 'application/resource-lists+xml';

    const M_RLC = 'image/vnd.fujixerox.edmics-rlc';

    const M_RLD = 'application/resource-lists-diff+xml';

    const M_RM = 'application/vnd.rn-realmedia';

    const M_RMI = 'audio/midi';

    const M_RMP = 'audio/x-pn-realaudio-plugin';

    const M_RMS = 'application/vnd.jcp.javame.midlet-rms';

    const M_RMVB = 'application/vnd.rn-realmedia-vbr';

    const M_RNC = 'application/relax-ng-compact-syntax';

    const M_ROA = 'application/rpki-roa';

    const M_ROFF = 'text/troff';

    const M_RP9 = 'application/vnd.cloanto.rp9';

    const M_RPSS = 'application/vnd.nokia.radio-presets';

    const M_RPST = 'application/vnd.nokia.radio-preset';

    const M_RQ = 'application/sparql-query';

    const M_RS = 'application/rls-services+xml';

    const M_RSD = 'application/rsd+xml';

    const M_RSS = 'application/rss+xml';

    const M_RTF = 'application/rtf';

    const M_RTX = 'text/richtext';

    const M_S = 'text/x-asm';

    const M_S3M = 'audio/s3m';

    const M_SAF = 'application/vnd.yamaha.smaf-audio';

    const M_SBML = 'application/sbml+xml';

    const M_SC = 'application/vnd.ibm.secure-container';

    const M_SCD = 'application/x-msschedule';

    const M_SCM = 'application/vnd.lotus-screencam';

    const M_SCQ = 'application/scvp-cv-request';

    const M_SCS = 'application/scvp-cv-response';

    const M_SCURL = 'text/vnd.curl.scurl';

    const M_SDA = 'application/vnd.stardivision.draw';

    const M_SDC = 'application/vnd.stardivision.calc';

    const M_SDD = 'application/vnd.stardivision.impress';

    const M_SDKD = 'application/vnd.solent.sdkm+xml';

    const M_SDKM = 'application/vnd.solent.sdkm+xml';

    const M_SDP = 'application/sdp';

    const M_SDW = 'application/vnd.stardivision.writer';

    const M_SEE = 'application/vnd.seemail';

    const M_SEED = 'application/vnd.fdsn.seed';

    const M_SEMA = 'application/vnd.sema';

    const M_SEMD = 'application/vnd.semd';

    const M_SEMF = 'application/vnd.semf';

    const M_SER = 'application/java-serialized-object';

    const M_SETPAY = 'application/set-payment-initiation';

    const M_SETREG = 'application/set-registration-initiation';

    const M_SFD_HDSTX = 'application/vnd.hydrostatix.sof-data';

    const M_SFS = 'application/vnd.spotfire.sfs';

    const M_SFV = 'text/x-sfv';

    const M_SGI = 'image/sgi';

    const M_SGL = 'application/vnd.stardivision.writer-global';

    const M_SGM = 'text/sgml';

    const M_SGML = 'text/sgml';

    const M_SH = 'application/x-sh';

    const M_SHAR = 'application/x-shar';

    const M_SHF = 'application/shf+xml';

    const M_SID = 'image/x-mrsid-image';

    const M_SIG = 'application/pgp-signature';

    const M_SIL = 'audio/silk';

    const M_SILO = 'model/mesh';

    const M_SIS = 'application/vnd.symbian.install';

    const M_SISX = 'application/vnd.symbian.install';

    const M_SIT = 'application/x-stuffit';

    const M_SITX = 'application/x-stuffitx';

    const M_SKD = 'application/vnd.koan';

    const M_SKM = 'application/vnd.koan';

    const M_SKP = 'application/vnd.koan';

    const M_SKT = 'application/vnd.koan';

    const M_SLDM = 'application/vnd.ms-powerpoint.slide.macroenabled.12';

    const M_SLDX = 'application/vnd.openxmlformats-officedocument.presentationml.slide';

    const M_SLT = 'application/vnd.epson.salt';

    const M_SM = 'application/vnd.stepmania.stepchart';

    const M_SMF = 'application/vnd.stardivision.math';

    const M_SMI = 'application/smil+xml';

    const M_SMIL = 'application/smil+xml';

    const M_SMV = 'video/x-smv';

    const M_SMZIP = 'application/vnd.stepmania.package';

    const M_SND = 'audio/basic';

    const M_SNF = 'application/x-font-snf';

    const M_SO = 'application/octet-stream';

    const M_SPC = 'application/x-pkcs7-certificates';

    const M_SPF = 'application/vnd.yamaha.smaf-phrase';

    const M_SPL = 'application/x-futuresplash';

    const M_SPOT = 'text/vnd.in3d.spot';

    const M_SPP = 'application/scvp-vp-response';

    const M_SPQ = 'application/scvp-vp-request';

    const M_SPX = 'audio/ogg';

    const M_SQL = 'application/x-sql';

    const M_SRC = 'application/x-wais-source';

    const M_SRT = 'application/x-subrip';

    const M_SRU = 'application/sru+xml';

    const M_SRX = 'application/sparql-results+xml';

    const M_SSDL = 'application/ssdl+xml';

    const M_SSE = 'application/vnd.kodak-descriptor';

    const M_SSF = 'application/vnd.epson.ssf';

    const M_SSML = 'application/ssml+xml';

    const M_ST = 'application/vnd.sailingtracker.track';

    const M_STC = 'application/vnd.sun.xml.calc.template';

    const M_STD = 'application/vnd.sun.xml.draw.template';

    const M_STF = 'application/vnd.wt.stf';

    const M_STI = 'application/vnd.sun.xml.impress.template';

    const M_STK = 'application/hyperstudio';

    const M_STL = 'application/vnd.ms-pki.stl';

    const M_STR = 'application/vnd.pg.format';

    const M_STW = 'application/vnd.sun.xml.writer.template';

    const M_SUB = 'text/vnd.dvb.subtitle';

    const M_SUS = 'application/vnd.sus-calendar';

    const M_SUSP = 'application/vnd.sus-calendar';

    const M_SV4CPIO = 'application/x-sv4cpio';

    const M_SV4CRC = 'application/x-sv4crc';

    const M_SVC = 'application/vnd.dvb.service';

    const M_SVD = 'application/vnd.svd';

    const M_SVG = 'image/svg+xml';

    const M_SVGZ = 'image/svg+xml';

    const M_SWA = 'application/x-director';

    const M_SWF = 'application/x-shockwave-flash';

    const M_SWI = 'application/vnd.aristanetworks.swi';

    const M_SXC = 'application/vnd.sun.xml.calc';

    const M_SXD = 'application/vnd.sun.xml.draw';

    const M_SXG = 'application/vnd.sun.xml.writer.global';

    const M_SXI = 'application/vnd.sun.xml.impress';

    const M_SXM = 'application/vnd.sun.xml.math';

    const M_SXW = 'application/vnd.sun.xml.writer';

    const M_T = 'text/troff';

    const M_T3 = 'application/x-t3vm-image';

    const M_TAGLET = 'application/vnd.mynfc';

    const M_TAO = 'application/vnd.tao.intent-module-archive';

    const M_TAR = 'application/x-tar';

    const M_TCAP = 'application/vnd.3gpp2.tcap';

    const M_TCL = 'application/x-tcl';

    const M_TEACHER = 'application/vnd.smart.teacher';

    const M_TEI = 'application/tei+xml';

    const M_TEICORPUS = 'application/tei+xml';

    const M_TEX = 'application/x-tex';

    const M_TEXI = 'application/x-texinfo';

    const M_TEXINFO = 'application/x-texinfo';

    const M_TEXT = 'text/plain';

    const M_TFI = 'application/thraud+xml';

    const M_TFM = 'application/x-tex-tfm';

    const M_TGA = 'image/x-tga';

    const M_THMX = 'application/vnd.ms-officetheme';

    const M_TIF = 'image/tiff';

    const M_TIFF = 'image/tiff';

    const M_TMO = 'application/vnd.tmobile-livetv';

    const M_TORRENT = 'application/x-bittorrent';

    const M_TPL = 'application/vnd.groove-tool-template';

    const M_TPT = 'application/vnd.trid.tpt';

    const M_TR = 'text/troff';

    const M_TRA = 'application/vnd.trueapp';

    const M_TRM = 'application/x-msterminal';

    const M_TSD = 'application/timestamped-data';

    const M_TSV = 'text/tab-separated-values';

    const M_TTC = 'application/x-font-ttf';

    const M_TTF = 'application/x-font-ttf';

    const M_TTL = 'text/turtle';

    const M_TWD = 'application/vnd.simtech-mindmapper';

    const M_TWDS = 'application/vnd.simtech-mindmapper';

    const M_TXD = 'application/vnd.genomatix.tuxedo';

    const M_TXF = 'application/vnd.mobius.txf';

    const M_TXT = 'text/plain';

    const M_U32 = 'application/x-authorware-bin';

    const M_UDEB = 'application/x-debian-package';

    const M_UFD = 'application/vnd.ufdl';

    const M_UFDL = 'application/vnd.ufdl';

    const M_ULX = 'application/x-glulx';

    const M_UMJ = 'application/vnd.umajin';

    const M_UNITYWEB = 'application/vnd.unity';

    const M_UOML = 'application/vnd.uoml+xml';

    const M_URI = 'text/uri-list';

    const M_URIS = 'text/uri-list';

    const M_URLS = 'text/uri-list';

    const M_USTAR = 'application/x-ustar';

    const M_UTZ = 'application/vnd.uiq.theme';

    const M_UU = 'text/x-uuencode';

    const M_UVA = 'audio/vnd.dece.audio';

    const M_UVD = 'application/vnd.dece.data';

    const M_UVF = 'application/vnd.dece.data';

    const M_UVG = 'image/vnd.dece.graphic';

    const M_UVH = 'video/vnd.dece.hd';

    const M_UVI = 'image/vnd.dece.graphic';

    const M_UVM = 'video/vnd.dece.mobile';

    const M_UVP = 'video/vnd.dece.pd';

    const M_UVS = 'video/vnd.dece.sd';

    const M_UVT = 'application/vnd.dece.ttml+xml';

    const M_UVU = 'video/vnd.uvvu.mp4';

    const M_UVV = 'video/vnd.dece.video';

    const M_UVVA = 'audio/vnd.dece.audio';

    const M_UVVD = 'application/vnd.dece.data';

    const M_UVVF = 'application/vnd.dece.data';

    const M_UVVG = 'image/vnd.dece.graphic';

    const M_UVVH = 'video/vnd.dece.hd';

    const M_UVVI = 'image/vnd.dece.graphic';

    const M_UVVM = 'video/vnd.dece.mobile';

    const M_UVVP = 'video/vnd.dece.pd';

    const M_UVVS = 'video/vnd.dece.sd';

    const M_UVVT = 'application/vnd.dece.ttml+xml';

    const M_UVVU = 'video/vnd.uvvu.mp4';

    const M_UVVV = 'video/vnd.dece.video';

    const M_UVVX = 'application/vnd.dece.unspecified';

    const M_UVVZ = 'application/vnd.dece.zip';

    const M_UVX = 'application/vnd.dece.unspecified';

    const M_UVZ = 'application/vnd.dece.zip';

    const M_VCARD = 'text/vcard';

    const M_VCD = 'application/x-cdlink';

    const M_VCF = 'text/x-vcard';

    const M_VCG = 'application/vnd.groove-vcard';

    const M_VCS = 'text/x-vcalendar';

    const M_VCX = 'application/vnd.vcx';

    const M_VIS = 'application/vnd.visionary';

    const M_VIV = 'video/vnd.vivo';

    const M_VOB = 'video/x-ms-vob';

    const M_VOR = 'application/vnd.stardivision.writer';

    const M_VOX = 'application/x-authorware-bin';

    const M_VRML = 'model/vrml';

    const M_VSD = 'application/vnd.visio';

    const M_VSF = 'application/vnd.vsf';

    const M_VSS = 'application/vnd.visio';

    const M_VST = 'application/vnd.visio';

    const M_VSW = 'application/vnd.visio';

    const M_VTU = 'model/vnd.vtu';

    const M_VXML = 'application/voicexml+xml';

    const M_W3D = 'application/x-director';

    const M_WAD = 'application/x-doom';

    const M_WAV = 'audio/x-wav';

    const M_WAX = 'audio/x-ms-wax';

    const M_WBMP = 'image/vnd.wap.wbmp';

    const M_WBS = 'application/vnd.criticaltools.wbs+xml';

    const M_WBXML = 'application/vnd.wap.wbxml';

    const M_WCM = 'application/vnd.ms-works';

    const M_WDB = 'application/vnd.ms-works';

    const M_WDP = 'image/vnd.ms-photo';

    const M_WEBA = 'audio/webm';

    const M_WEBM = 'video/webm';

    const M_WEBP = 'image/webp';

    const M_WG = 'application/vnd.pmi.widget';

    const M_WGT = 'application/widget';

    const M_WKS = 'application/vnd.ms-works';

    const M_WM = 'video/x-ms-wm';

    const M_WMA = 'audio/x-ms-wma';

    const M_WMD = 'application/x-ms-wmd';

    const M_WMF = 'application/x-msmetafile';

    const M_WML = 'text/vnd.wap.wml';

    const M_WMLC = 'application/vnd.wap.wmlc';

    const M_WMLS = 'text/vnd.wap.wmlscript';

    const M_WMLSC = 'application/vnd.wap.wmlscriptc';

    const M_WMV = 'video/x-ms-wmv';

    const M_WMX = 'video/x-ms-wmx';

    const M_WMZ = 'application/x-msmetafile';

    const M_WOFF = 'application/font-woff';

    const M_WPD = 'application/vnd.wordperfect';

    const M_WPL = 'application/vnd.ms-wpl';

    const M_WPS = 'application/vnd.ms-works';

    const M_WQD = 'application/vnd.wqd';

    const M_WRI = 'application/x-mswrite';

    const M_WRL = 'model/vrml';

    const M_WSDL = 'application/wsdl+xml';

    const M_WSPOLICY = 'application/wspolicy+xml';

    const M_WTB = 'application/vnd.webturbo';

    const M_WVX = 'video/x-ms-wvx';

    const M_X32 = 'application/x-authorware-bin';

    const M_X3D = 'model/x3d+xml';

    const M_X3DB = 'model/x3d+binary';

    const M_X3DBZ = 'model/x3d+binary';

    const M_X3DV = 'model/x3d+vrml';

    const M_X3DVZ = 'model/x3d+vrml';

    const M_X3DZ = 'model/x3d+xml';

    const M_XAML = 'application/xaml+xml';

    const M_XAP = 'application/x-silverlight-app';

    const M_XAR = 'application/vnd.xara';

    const M_XBAP = 'application/x-ms-xbap';

    const M_XBD = 'application/vnd.fujixerox.docuworks.binder';

    const M_XBM = 'image/x-xbitmap';

    const M_XDF = 'application/xcap-diff+xml';

    const M_XDM = 'application/vnd.syncml.dm+xml';

    const M_XDP = 'application/vnd.adobe.xdp+xml';

    const M_XDSSC = 'application/dssc+xml';

    const M_XDW = 'application/vnd.fujixerox.docuworks';

    const M_XENC = 'application/xenc+xml';

    const M_XER = 'application/patch-ops-error+xml';

    const M_XFDF = 'application/vnd.adobe.xfdf';

    const M_XFDL = 'application/vnd.xfdl';

    const M_XHT = 'application/xhtml+xml';

    const M_XHTML = 'application/xhtml+xml';

    const M_XHVML = 'application/xv+xml';

    const M_XIF = 'image/vnd.xiff';

    const M_XLA = 'application/vnd.ms-excel';

    const M_XLAM = 'application/vnd.ms-excel.addin.macroenabled.12';

    const M_XLC = 'application/vnd.ms-excel';

    const M_XLF = 'application/x-xliff+xml';

    const M_XLM = 'application/vnd.ms-excel';

    const M_XLS = 'application/vnd.ms-excel';

    const M_XLSB = 'application/vnd.ms-excel.sheet.binary.macroenabled.12';

    const M_XLSM = 'application/vnd.ms-excel.sheet.macroenabled.12';

    const M_XLSX = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

    const M_XLT = 'application/vnd.ms-excel';

    const M_XLTM = 'application/vnd.ms-excel.template.macroenabled.12';

    const M_XLTX = 'application/vnd.openxmlformats-officedocument.spreadsheetml.template';

    const M_XLW = 'application/vnd.ms-excel';

    const M_XM = 'audio/xm';

    const M_XML = 'application/xml';

    const M_XO = 'application/vnd.olpc-sugar';

    const M_XOP = 'application/xop+xml';

    const M_XPI = 'application/x-xpinstall';

    const M_XPL = 'application/xproc+xml';

    const M_XPM = 'image/x-xpixmap';

    const M_XPR = 'application/vnd.is-xpr';

    const M_XPS = 'application/vnd.ms-xpsdocument';

    const M_XPW = 'application/vnd.intercon.formnet';

    const M_XPX = 'application/vnd.intercon.formnet';

    const M_XSL = 'application/xml';

    const M_XSLT = 'application/xslt+xml';

    const M_XSM = 'application/vnd.syncml+xml';

    const M_XSPF = 'application/xspf+xml';

    const M_XUL = 'application/vnd.mozilla.xul+xml';

    const M_XVM = 'application/xv+xml';

    const M_XVML = 'application/xv+xml';

    const M_XWD = 'image/x-xwindowdump';

    const M_XYZ = 'chemical/x-xyz';

    const M_XZ = 'application/x-xz';

    const M_YANG = 'application/yang';

    const M_YIN = 'application/yin+xml';

    const M_Z1 = 'application/x-zmachine';

    const M_Z2 = 'application/x-zmachine';

    const M_Z3 = 'application/x-zmachine';

    const M_Z4 = 'application/x-zmachine';

    const M_Z5 = 'application/x-zmachine';

    const M_Z6 = 'application/x-zmachine';

    const M_Z7 = 'application/x-zmachine';

    const M_Z8 = 'application/x-zmachine';

    const M_ZAZ = 'application/vnd.zzazz.deck+xml';

    const M_ZIP = 'application/zip';

    const M_ZIR = 'application/vnd.zul';

    const M_ZIRZ = 'application/vnd.zul';

    const M_ZMM = 'application/vnd.handheld-entertainment+xml';

    const M_123 = 'application/vnd.lotus-1-2-3';
}
