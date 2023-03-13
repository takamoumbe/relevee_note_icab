/******************************************************************************************************/ CGE

CREATE TABLE "etudiant_cge" (
	"id"	INTEGER NOT NULL UNIQUE,
	"matricule"	NUMERIC NOT NULL,
	"nom"	TEXT,
	"date_naiss"	TEXT,
	"lieu_naiss"	TEXT,
	"sexe"	TEXT,
	"filiere"	TEXT,
	"niveau"	TEXT,

	"opera_cou_I"	REAL,
	"opera_speci_I"	REAL,
	"compta_anal_I"	REAL,
	"intro_fisc"	REAL,
	"intro_analyse_fin_I"	REAL,
	"math_fin_I"	REAL,
	"math_gene_I"	REAL,
	"info_gene_I"	REAL,
	"stat_I"	REAL,
	"francais"	REAL,
	"econo_gene"	REAL,
	"opera_cou_II"	REAL,
	"opera_speci_II"	REAL,
	"compta_anal_II"	REAL,
	"compta_societe_I"	REAL,
	"math_fin_II"	REAL,
	"math_gene_II"	REAL,
	"recherche_opera"	REAL,
	"anglais"	REAL,
	"econo_orga_entre"	REAL,
	"qrCode"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT)
)


/******************************************************************************************************/ GC

CREATE TABLE "etudiant_batiment" (
	"id"	INTEGER NOT NULL UNIQUE,
	"matricule"	NUMERIC NOT NULL,
	"nom"	TEXT,
	"date_naiss"	TEXT,
	"lieu_naiss"	TEXT,
	"sexe"	TEXT,
	"filiere"	TEXT,
	"niveau"	TEXT,
	
	"physi_I"	REAL,
	"physi_II"	REAL,
	"chimie"	REAL,
	"proce_gene_const_I"	REAL,
	"dessin_tech_bati"	REAL,
	"organi_chantier"	REAL,
	"architecture"	REAL,
	"resis_mat_I"	REAL,
	"route_I"	REAL,
	"projet_beton_ar"	REAL,
	"pro_gene_const_II"	REAL,
	"topographie_I"	REAL,
	"beton_arme_I"	REAL,
	"geometrique"	REAL,
	"resis_mat_II"	REAL,
	"math_I"	REAL,
	"math_II"	REAL,
	"info_I"	REAL,
	"forma_bilingue"	REAL,
	"francais"	REAL,
	"entrepreunariat"	REAL,
	"ethique"	REAL,
	"qrCode"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT)
)

/******************************************************************************************************/ IIA

CREATE TABLE "etudiant_iia" (
	"id"	INTEGER NOT NULL UNIQUE,
	"matricule"	NUMERIC NOT NULL,
	"nom"	TEXT,
	"date_naiss"	TEXT,
	"lieu_naiss"	TEXT,
	"sexe"	TEXT,
	"filiere"	TEXT,
	"niveau"	TEXT,
	
	"algo_progra"	REAL,
	"eletrotech_I"	REAL,
	"elect_puissance_I"	REAL,
	"elect_de_base_I"	REAL,
	"circuit_log_I"	REAL,
	"reseseau_teleinfo"	REAL,
	"domoti_I"	REAL,
	"phy_gene_I"	REAL,
	"analyse_math_I"	REAL,
	"algebre_line_I"	REAL,
	"anglais"	REAL,
	"compta_gene"	REAL,
	"domoti_II"	REAL,
	"archi_ordi"	REAL,
	"schema_elect"	REAL,
	"circuit_elect"	REAL,
	"elect_grand_pub"	REAL,
	"telecom"	REAL,
	"circuit_logi_II"	REAL,
	"metrologie"	REAL,
	"analyse_math_II"	REAL,
	"algebre_line_II"	REAL,
	"init_informatique"	REAL,
	"econo_orga_entre"	REAL,
	"francais"	REAL,
	"qrCode"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT)
)


/******************************************************************************************************/GLT

CREATE TABLE "etudiant_glt" (
	"id"	INTEGER NOT NULL UNIQUE,
	"matricule"	NUMERIC NOT NULL,
	"nom"	TEXT,
	"date_naiss"	TEXT,
	"lieu_naiss"	TEXT,
	"sexe"	TEXT,
	"filiere"	TEXT,
	"niveau"	TEXT,
	
	"geo_flux_tran_voy_I"	REAL,
	"ele_base_log_I"	REAL,
	"marke_app_trans_I"	REAL,
	"nego_achat_ven_I"	REAL,
	"trans_aeri_I"	REAL,
	"trans_mart_flu_I"	REAL,
	"trans_terestre_I"	REAL,
	"math_gene_I"	REAL,
	"info_I"	REAL,
	"math_fin_I"	REAL,
	"stat_I"	REAL,
	"compta_gene_I"	REAL,
	"francais"	REAL,
	"econo_gene"	REAL,
	"geo_flux_tran_voy_II"	REAL,
	"ele_base_log_II"	REAL,
	"marke_app_trans_II"	REAL,
	"nego_achat_ven_II"	REAL,
	"trans_aeri_II"	REAL,
	"trans_mart_flu_II"	REAL,
	"trans_terest_II"	REAL,
	"metho_reda_rap_stagr"	REAL,
	"compta_gene_II"	REAL,
	"anglais"	REAL,
	"econo_orga_entre"	REAL,
	"qrCode"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT)
)



/******************************************************************************************************/MCV
CREATE TABLE "etudiant_mcv" (
	"id"	INTEGER NOT NULL UNIQUE,
	"matricule"	NUMERIC NOT NULL,
	"nom"	TEXT,
	"date_naiss"	TEXT,
	"lieu_naiss"	TEXT,
	"sexe"	TEXT,
	"filiere"	TEXT,
	"niveau"	TEXT,
	"mark_fond_1"	REAL,
	"mark_in_1"	REAL,
	"pol_pro"	REAL,
	"pol_prix"	REAL,
	"tech_vent"	REAL,
	"veil_conc"	REAL,
	"forc_vent_1"	REAL,
	"etud_mar_1"	REAL,
	"gest_com"	REAL,
	"math_gen_1"	REAL,
	"info_gen_1"	REAL,
	"math_fin_1"	REAL,
	"stat"	REAL,
	"exp_franc"	REAL,
	"eco_gen"	REAL,
	"mark_fond_2"	REAL,
	"mark_int_2"	REAL,
	"etud_mar_2"	REAL,
	"gest_com_2"	REAL,
	"tech_neg_com"	REAL,
	"forc_vent_2"	REAL,
	"info_gen_2"	REAL,
	"math_gen_2"	REAL,
	"math_fin_2"	REAL,
	"comp_gen"	REAL,
	"exp_ang"	REAL,
	"eco_org_entre"	REAL,
	"qrCode"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT)
)

/******************************************************************************************************/GL

CREATE TABLE "etudiant" (
	"id"	INTEGER NOT NULL UNIQUE,
	"matricule"	NUMERIC NOT NULL,
	"nom"	TEXT,
	"date_naiss"	TEXT,
	"lieu_naiss"	TEXT,
	"sexe"	TEXT,
	"filiere"	TEXT,
	"niveau"	TEXT,
	"envi_b_1"	REAL,
	"outilsB"	REAL,
	"archi"	REAL,
	"algorithme"	REAL,
	"intro_si"	REAL,
	"intro_gl"	REAL,
	"trait_donnee_mult"	REAL,
	"algebre_l"	REAL,
	"ana_math_1"	REAL,
	"anglais"	REAL,
	"compta"	REAL,
	"s_exploi_1"	REAL,
	"web_1"	REAL,
	"progra_1"	REAL,
	"intro_bd"	REAL,
	"s_infor_2"	REAL,
	"progra_evene_1"	REAL,
	"min_projet"	REAL,
	"ins_maint_mat_log"	REAL,
	"nego_info"	REAL,
	"alge_bool_circuit"	REAL,
	"stat_des"	REAL,
	"economie"	REAL,
	"francais"	REAL,
	"qrCode"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT)
)



/******************************************************************************************************/BIF

CREATE TABLE "etudiant_bif" (
	"id"	INTEGER NOT NULL UNIQUE,
	"matricule"	NUMERIC NOT NULL,
	"nom"	TEXT,
	"date_naiss"	TEXT,
	"lieu_naiss"	TEXT,
	"sexe"	TEXT,
	"filiere"	TEXT,
	"niveau"	TEXT,
	"math_gene_I"	REAL,
	"info_gene_I"	REAL,
	"math_fin_I"	REAL,
	"compta_gene_I"	REAL,
	"ethiq_deont_banc"	REAL,
	"reglemt_banc"	REAL,
	"tech_banc_march_parti"	REAL,
	"opera_banc_tansfro_I"	REAL,
	"strat_mark_banc"	REAL,
	"syst_fin_decentr_I"	REAL,
	"fin_islami_I"	REAL,
	"march_des_capit_I"	REAL,
	"econo_moneta_I"	REAL,
	"econo_banc_I"	REAL,
	"expre_franc"	REAL,
	"econo_gene"	REAL,
	"math_fin_II"	REAL,
	"stati_II"	REAL,
	"analyse_finan"	REAL,
	"droit"	REAL,
	"fisc_des_opre_banc"	REAL,
	"teh_banc_marc_des_ent_I"	REAL,
	"opera_banc_tansfro_II"	REAL,
	"syst_fin_decentr_II"	REAL,
	"fin_islami_II"	REAL,
	"march_des_capit_II"	REAL,
	"econo_moneta_II"	REAL,
	"econo_banc_II"	REAL,
	"expre_angl"	REAL,
	"econo_org_des_ent"	REAL,
	"qrCode"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT)
)


CREATE TABLE "etudiant_bif" (
	"id"	INTEGER NOT NULL UNIQUE,
	"matricule"	NUMERIC NOT NULL,
	"nom"	TEXT,
	"date_naiss"	TEXT,
	"lieu_naiss"	TEXT,
	"sexe"	TEXT,
	"filiere"	TEXT,
	"niveau"	TEXT,
	"math_gene_I"	REAL,
	"info_gene_I"	REAL,
	"math_fin_I"	REAL,
	"reglemt_banc"	REAL,
	"tech_banc_march_parti"	REAL,
	"opera_banc_tansfro_I"	REAL,
	"strat_mark_banc"	REAL,
	"econo_banc_I"	REAL,
	"syst_fin_decentr_I"	REAL,
	"fin_islami_I"	REAL,
	"march_des_capit_I"	REAL,
	"econo_moneta_I"	REAL,
	"expre_franc"	REAL,
	"econo_gene"	REAL,
	"compta_gene_I"	REAL,
	"ethiq_deont_banc"	REAL,
	"math_fin_II"	REAL,
	"fisc_des_opre_banc"	REAL,
	"analyse_finan"	REAL,
	"teh_banc_marc_des_ent_I"	REAL,
	"opera_banc_tansfro_II"	REAL,
	"syst_fin_decentr_II"	REAL,
	"fin_islami_II"	REAL,
	"econo_moneta_II"	REAL,
	"econo_banc_II"	REAL,
	"expre_angl"	REAL,
	"econo_org_des_ent"	REAL,
	"qrCode"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT)
)


