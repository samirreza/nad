<?php

use yii\db\Migration;

/**
 * Class m200517_205512_rla_stuff
 */
class m200517_205512_rla_stuff extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
-- ADD seq_access_id COLUMN
-- alter table audit_trail add column seq_access_id BIGINT UNIQUE null;
--  alter table auth_assignment add column seq_access_id BIGINT UNIQUE null;
--  alter table auth_item add column seq_access_id BIGINT UNIQUE null;
--  alter table auth_item_child add column seq_access_id BIGINT UNIQUE null;
--  alter table auth_rule add column seq_access_id BIGINT UNIQUE null;
--  alter table change_log add column seq_access_id BIGINT UNIQUE null;
--  alter table `comment` add column seq_access_id BIGINT UNIQUE null;
--  alter table `file` add column seq_access_id BIGINT UNIQUE null;
--  alter table gallery add column seq_access_id BIGINT UNIQUE null;
--  alter table gallery_image add column seq_access_id BIGINT UNIQUE null;
--  alter table lookup add column seq_access_id BIGINT UNIQUE null;
--  alter table migration add column seq_access_id BIGINT UNIQUE null;
 alter table module_documentation add column seq_access_id BIGINT UNIQUE null;
 alter table module_documentation_file add column seq_access_id BIGINT UNIQUE null;
 alter table nad_build_material add column seq_access_id BIGINT UNIQUE null;
 alter table nad_build_material_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_end_equipment_document add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_device add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_device_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_device_category_document add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_device_document_group add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_device_document_group_document add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_device_instance add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_device_instance_document add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_device_part add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_device_part_document add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_device_part_instance add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_device_part_instance_document add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_document add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_document_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_location add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_location_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_plant add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_plant_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_resource add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_resource_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_site add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_site_document add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_stage add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_stage_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_eng_stage_document add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_document_type add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_material add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_material_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_model add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_model_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_sample add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_sample_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_tool add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_tool_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_type add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_type_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_type_document add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_type_fitting add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_type_part add column seq_access_id BIGINT UNIQUE null;
 alter table nad_equipment_type_part_model add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_instruction add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_instruction_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_instruction_partner_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_method add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_method_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_method_partner_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_proposal add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_proposal_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_proposal_partner_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_reference add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_reference_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_reference_uses add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_report add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_report_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_report_partner_relation add column seq_access_id BIGINT UNIQUE null;
 -- alter table nad_investigation_source add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_source_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_source_expert_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_source_reason add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_source_reason_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_subject add column seq_access_id BIGINT UNIQUE null;
 alter table nad_investigation_subject_partner_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_it_depot_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_it_equipment add column seq_access_id BIGINT UNIQUE null;
 alter table nad_it_equipment_type add column seq_access_id BIGINT UNIQUE null;
 alter table nad_it_equipment_type_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_maker add column seq_access_id BIGINT UNIQUE null;
 alter table nad_maker_equipment_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_maker_part_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_maker_phonebook add column seq_access_id BIGINT UNIQUE null;
 alter table nad_maker_phonebook_jobs add column seq_access_id BIGINT UNIQUE null;
 alter table nad_maker_work_type add column seq_access_id BIGINT UNIQUE null;
 alter table nad_maker_work_type_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_module_thing_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_office_expert add column seq_access_id BIGINT UNIQUE null;
 alter table nad_repairer add column seq_access_id BIGINT UNIQUE null;
 alter table nad_repairer_equipment_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_repairer_part_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_repairer_phonebook add column seq_access_id BIGINT UNIQUE null;
 alter table nad_repairer_phonebook_jobs add column seq_access_id BIGINT UNIQUE null;
 alter table nad_repairer_work_type add column seq_access_id BIGINT UNIQUE null;
 alter table nad_repairer_work_type_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_report_graph add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_lab_equipment_type add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_lab_equipment_type_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_material add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_material_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_project add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_project_category add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_proposal add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_proposal_partner_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_resource add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_resource_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_source add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_source_expert_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_source_reason add column seq_access_id BIGINT UNIQUE null;
 alter table nad_research_source_reason_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_supplier add column seq_access_id BIGINT UNIQUE null;
 alter table nad_supplier_equipment_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_supplier_material_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_supplier_part_relation add column seq_access_id BIGINT UNIQUE null;
 alter table nad_supplier_phonebook add column seq_access_id BIGINT UNIQUE null;
 alter table nad_supplier_phonebook_jobs add column seq_access_id BIGINT UNIQUE null;
--  alter table notification add column seq_access_id BIGINT UNIQUE null;
--  alter table page add column seq_access_id BIGINT UNIQUE null;
--  alter table post add column seq_access_id BIGINT UNIQUE null;
--  alter table post_category add column seq_access_id BIGINT UNIQUE null;
--  alter table post_category_relation add column seq_access_id BIGINT UNIQUE null;
--  alter table row_level_access add column seq_access_id BIGINT UNIQUE null;
--  alter table setting add column seq_access_id BIGINT UNIQUE null;
--  alter table tag add column seq_access_id BIGINT UNIQUE null;
--  alter table tag_module add column seq_access_id BIGINT UNIQUE null;
--  alter table `user` add column seq_access_id BIGINT UNIQUE null;


-- FILL seq_access_id COLUMN
-- update audit_trail set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update auth_assignment set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update auth_item set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update auth_item_child set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update auth_rule set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update change_log set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update `comment` set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update `file` set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update gallery set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update gallery_image set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update lookup set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update migration set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update module_documentation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update module_documentation_file set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_build_material set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_build_material_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_end_equipment_document set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_device set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_device_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_device_category_document set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_device_document_group set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_device_document_group_document set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_device_instance set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_device_instance_document set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_device_part set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_device_part_document set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_device_part_instance set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_device_part_instance_document set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_document set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_document_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_location set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_location_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_plant set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_plant_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_resource set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_resource_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_site set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_site_document set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_stage set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_stage_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_eng_stage_document set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_document_type set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_material set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_material_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_model set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_model_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_sample set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_sample_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_tool set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_tool_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_type set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_type_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_type_document set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_type_fitting set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_type_part set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_equipment_type_part_model set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_instruction set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_instruction_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_instruction_partner_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_method set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_method_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_method_partner_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_proposal set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_proposal_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_proposal_partner_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_reference set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_reference_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_reference_uses set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_report set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_report_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_report_partner_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 -- update nad_investigation_source set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_source_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_source_expert_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_source_reason set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_source_reason_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_subject set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_investigation_subject_partner_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_it_depot_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_it_equipment set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_it_equipment_type set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_it_equipment_type_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_maker set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_maker_equipment_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_maker_part_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_maker_phonebook set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_maker_phonebook_jobs set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_maker_work_type set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_maker_work_type_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_module_thing_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_office_expert set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_repairer set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_repairer_equipment_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_repairer_part_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_repairer_phonebook set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_repairer_phonebook_jobs set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_repairer_work_type set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_repairer_work_type_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_report_graph set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_lab_equipment_type set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_lab_equipment_type_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_material set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_material_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_project set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_project_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_proposal set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_proposal_partner_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_resource set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_resource_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_source set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_source_expert_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_source_reason set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_research_source_reason_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_supplier set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_supplier_equipment_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_supplier_material_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_supplier_part_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_supplier_phonebook set seq_access_id = nextval(seq_access) where seq_access_id is null;
 update nad_supplier_phonebook_jobs set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update notification set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update page set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update post set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update post_category set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update post_category_relation set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update row_level_access set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update setting set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update tag set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update tag_module set seq_access_id = nextval(seq_access) where seq_access_id is null;
--  update `user` set seq_access_id = nextval(seq_access) where seq_access_id is null
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200517_205512_rla_stuff cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200517_205512_rla_stuff cannot be reverted.\n";

        return false;
    }
    */
}
