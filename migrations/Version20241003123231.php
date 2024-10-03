<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241003123231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create buffs table and insert initial data for Legends server';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE buffs (`id` INT AUTO_INCREMENT NOT NULL, `server` VARCHAR(255) NOT NULL, `category` VARCHAR(255) NOT NULL, `name` VARCHAR(255) NOT NULL, `cost` INT NOT NULL, `max_assignments` INT NOT NULL, `effect` INT NOT NULL, `description` VARCHAR(255) NOT NULL, `prefix` VARCHAR(255) NOT NULL, `suffix` VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql(
            'INSERT INTO buffs (`id`, `server`, `category`, `name`, `cost`, `max_assignments`, `effect`, `description`, `prefix`, `suffix`) '
            . 'VALUES '
            . '(1100, "legends", "Attributes", "Agility", 1, 10, 30, "30 to attribute per package.", "+", " to agility attribute"), '
            . '(1101, "legends", "Attributes", "Constitution", 1, 10, 30, "30 to attribute per package", "+", " to constitution attribute"), '
            . '(1102, "legends", "Attributes", "Luck", 1, 10, 30, "30 to attribute per package", "+", " to luck attribute"), '
            . '(1103, "legends", "Attributes", "Precision", 1, 10, 30, "30 to attribute per package", "+", " to precision attribute"), '
            . '(1104, "legends", "Attributes", "Stamina", 1, 10, 30, "30 to attribute per package", "+", " to stamina attribute"), '
            . '(1105, "legends", "Attributes", "Strength", 1, 10, 30, "30 to attribute per package", "+", " to strength attribute"), '
            . '(1200, "legends", "Combat", "Action Cost Reduction", 5, 1, 9, "9% bonus per package in reducing all action costs", "", "% bonus in reducing all action costs"), '
            . '(1201, "legends", "Combat", "Critical Hit", 5, 1, 7, "7% bonus per package to critical hit chance", "", "% bonus to critical hit chance"), '
            . '(1202, "legends", "Combat", "Critical Hit Defense", 5, 1, 7, "7% bonus per package to critical hit defense", "", "% bonus to critical hit defense"), '
            . '(1203, "legends", "Combat", "Glancing Blow", 5, 1, 7, "7% bonus per package to glancing blow", "", "% bonus to glancing blow"), '
            . '(1300, "legends", "Miscellanious", "Flush With Success", 2, 5, 3, "3% increase per package in the amount of experience and GCW points earned (ground and space)", "", "% increased experience gain"), '
            . '(1301, "legends", "Miscellanious", "Harvest Faire", 2, 5, 1, "1% increase per package on the number of resources gathered with harvesters", "", "% increase on the number of resources gathered with harvesters"), '
            . '(1302, "legends", "Miscellanious", "Healer", 2, 5, 3, "Increase the strength of your heals by 3% per package", "Increase the strength of your healing by ", "%"), '
            . '(1303, "legends", "Miscellanious", "Resilience", 2, 5, 4, "Reduce the amount of damage received by damage over time effects by 4% per package", "Damage received by damage over time effects reduced by ", "%"), '
            . '(1304, "legends", "Miscellanious", "Go With The Flow", 2, 5, 5, "Increase all movement rates by 5% per package", "", "% increase to all movement rates"), '
            . '(1305, "legends", "Miscellanious", "Second Chance", 2, 4, 6, "6% chance per package to automatically heal damage when hit in combat", "", "% chance to automatically heal damage when struck in combat"), '
            . '(1306, "legends", "Miscellanious", "Camouflage Detection", 1, 5, 20, "+20 increase in Camouflage Detection per package.", "+", " increase in Camouflage Detection."), '
            . '(1400, "legends", "Resistances", "Elemental", 1, 5, 750, "750 to resistance per package", "+", " to resistance"), '
            . '(1401, "legends", "Resistances", "Energy", 1, 5, 750, "750 to resistance per package", "+", " to Energy protection"), '
            . '(1402, "legends", "Resistances", "Kinetic", 1, 5, 750, "750 to resistance per package", "+", " to Kinetic protection"), '
            . '(1500, "legends", "Trade", "Crafting Assembly", 2, 5, 2, "+2 increase to Assembly and Experience gain for all types of crafting per package", "+", " increase to Assembly and Experience gain for all types of crafting"), '
            . '(1501, "legends", "Trade", "Amazing Success Chance", 5, 2, 2, "2% bonus to Amazing Success crafting results per package", "", "% bonus to Amazing Success crafting results"), '
            . '(1502, "legends", "Trade", "Hand Sampling", 2, 5, 4, "4% increase to the number of resources gathered through hand sampling per package", "", "% increase to the number of resources gathered through hand sampling"), '
            . '(1503, "legends", "Trade", "Reverse Engineering Efficiency", 5, 2, 20, "+20 increase in Reverse Engineering Efficiency per package.", "+", " increase in Reverse Engineering Efficiency"), '
            . '(2100, "restoration", "Attributes", "Defense General", 1, 10, 10, "+10 to Defense General (Agility) Attribute per package.", "+", " to Defense General (Agility) Attribute."), '
            . '(2101, "restoration", "Attributes", "Toughness Boost", 1, 10, 10, "+10 to Toughness Boost (Constitution) Attribute per package.", "+", " to Toughness Boost (Constitution) Attribute."), '
            . '(2102, "restoration", "Attributes", "Opportune Chance", 1, 10, 10, "+10 to Opportune Chance (Luck) Attribute per package.", "+", " to Opportune Chance (Luck) Attribute."), '
            . '(2103, "restoration", "Attributes", "Ranged General", 1, 10, 10, "+10 to Ranged General (Precision) Attribute per package.", "+", " to Ranged General (Precision) Attribute."), '
            . '(2104, "restoration", "Attributes", "Endurance Boost", 1, 10, 10, "+10 to Endurance Boost (Stamina) Attribute per package.", "+", " to Endurance Boost (Stamina) Attribute."), '
            . '(2105, "restoration", "Attributes", "Melee General", 1, 10, 10, "+10 to Melee General (Strength) Attribute per package.", "+", " to Melee General (Strength) Attribute."), '
            . '(2200, "restoration", "Combat", "Action Cost Reduction", 5, 1, 5, "5% reduction to all action costs per package.", "", "% reduction to all action costs."), '
            . '(2201, "restoration", "Combat", "Critical Hit", 5, 1, 3, "3% increase to the chance to strike a critical hit per package.", "", "% increase to the chance to strike a critical hit."), '
            . '(2202, "restoration", "Combat", "Critical Hit Defense", 5, 1, 3, "3% decrease to the chance to be struck by a critical hit per package.", "", "% decrease to the chance to be struck by a critical hit."), '
            . '(2203, "restoration", "Combat", "Healing Efficiency", 2, 5, 3, "3% increase to the strength of your heals per package.", "", "% increase to the strength of your heals."), '
            . '(2204, "restoration", "Combat", "Knockdown Defense", 1, 5, 5, "+5 to defense against Knockdown per package.", "+", " to defense against Knockdown."), '
            . '(2205, "restoration", "Combat", "Melee Accuracy", 2, 5, 5, "+5 increase to Melee Accuracy per package.", "+", " increase to Melee Accuracy."), '
            . '(2206, "restoration", "Combat", "Melee Speed", 2, 5, 5, "+5 increase to Melee Speed per package.", "+", " increase to Melee Speed."), '
            . '(2207, "restoration", "Combat", "Ranged Accuracy", 2, 5, 5, "+5 increase to Ranged Accuracy per package.", "+", " increase to Ranged Accuracy."), '
            . '(2208, "restoration", "Combat", "Ranged Speed", 2, 5, 5, "+5 increase to Ranged Speed per package.", "+", " increase to Ranged Speed."), '
            . '(2209, "restoration", "Combat", "Movement Speed", 2, 5, 1, "1% increase to movement speed per package.", "", "% increase to your movement speed."), '
            . '(2210, "restoration", "Combat", "Second Chance", 2, 5, 4, "4% increase to the chance to automatically heal damage when hit in combat per package.", "", "% increase to the chance to automatically heal damage when hit in combat."), '
            . '(2211, "restoration", "Combat", "Resilience", 2, 5, 4, "4% reduction to the damage received by damage over time effects per package.", "", "% reduction to the damage received by damage over time effects."), '
            . '(2300, "restoration", "Utility", "Droid Find Speed", 1, 5, 5, "5% increase to Bounty Hunter Droid Find Speed per package.", "", "% increase to Bounty Hunter Droid Find Speed."), '
            . '(2301, "restoration", "Utility", "Flush With Success", 2, 5, 3, "3% increase to the experience points gained from all sources per package.", "", "% increase to the experience points gained from all sources."), '
            . '(2400, "restoration", "Player vs. Player (PvP)", "PvP Damage Reduction", 3, 2, 5, "5% decrease to damage dealt by other players during PvP per package.", "", "% decrease to damage dealt by other players during PvP."), '
            . '(2401, "restoration", "Player vs. Player (PvP)", "PvP Decay Reduction", 2, 5, 10, "10% reduction to weapon and armor decay from PvP per package.", "", "% reduction to weapon and armor decay from PvP."), '
            . '(2402, "restoration", "Player vs. Player (PvP)", "PvP DoT Defense", 1, 10, 5, "5% resistance to damage over time effects from other players during PvP per package.", "", "% resistance to damage over time effects from other players during PvP."), '
            . '(2500, "restoration", "Resistances", "Elemental Resistance", 1, 5, 225, "+225 to resistance protection against all types of elemental damage per package.", "+", " to resistance protection against all types of elemental damage."), '
            . '(2501, "restoration", "Resistances", "Energy Resistance", 1, 5, 200, "+200 to resistance protection against energy damage per package.", "+", " to resistance protection against energy damage."), '
            . '(2502, "restoration", "Resistances", "Kinetic Resistance", 1, 5, 200, "+200 to resistance protection against kinetic damage per package.", "+", " to resistance protection against kinetic damage."), '
            . '(2600, "restoration", "Crafting", "Crafting Assembly", 2, 5, 1, "+1 increase to General Assembly while crafting or making repairs per package.", "+", " increase to General Assembly while crafting or making repairs."), '
            . '(2601, "restoration", "Crafting", "Amazing Success Chance", 5, 2, 1, "1% increase to the chance to have an Amazing Success while crafting per package.", "", "% increase to the chance to have an Amazing Success while crafting."), '
            . '(2602, "restoration", "Crafting", "Factory Speed", 1, 5, 5, "5% increase to Factory Speed per package.", "", "% increase to Factory Speed."), '
            . '(2603, "restoration", "Crafting", "Hand Sampling", 2, 5, 2, "2% increase to the quantity of resources gathered through hand sampling per package.", "", "% increase to the quantity of resources gathered through hand sampling."), '
            . '(2604, "restoration", "Crafting", "Harvest Faire", 2, 5, 1, "1% increase to the quantity of resources gathered by harvesters per package.", "", "% increase to the quantity of resources gathered by harvesters."), '
            . '(2605, "restoration", "Crafting", "Resource Quality", 5, 2, 2, "2% increase to Resource Quality when crafting per package.", "", "% increase to Resource Quality when crafting."), '
            . '(3100, "resurgence", "Attributes", "Agility", 1, 10, 45, "45 to attribute per package.", "+", " to agility attribute"), '
            . '(3101, "resurgence", "Attributes", "Block Value", 1, 10, 45, "45 to block value per package", "", " to block value"), '
            . '(3102, "resurgence", "Attributes", "Camouflage", 1, 10, 45, "45 to Camouflage per package", "", " to camouflage"), '
            . '(3103, "resurgence", "Attributes", "Constitution", 1, 10, 45, "45 to attribute per package", "+", " to constitution attribute"), '
            . '(3104, "resurgence", "Attributes", "Detect Camouflage", 1, 10, 45, "45 to Detect Camouflage per package", "", " to Detect Camouflage"), '
            . '(3105, "resurgence", "Attributes", "Evasion Value", 1, 10, 45, "45 to evasion value per package", "", " to evasion value"), '
            . '(3106, "resurgence", "Attributes", "Luck", 1, 10, 45, "45 to attribute per package", "+", " to luck attribute"), '
            . '(3107, "resurgence", "Attributes", "Precision", 1, 10, 45, "45 to attribute per package.", "+", " to precision attribute"), '
            . '(3108, "resurgence", "Attributes", "Stamina", 1, 10, 45, "45 to attribute per package.", "+", " to stamina attribute"), '
            . '(3109, "resurgence", "Attributes", "Strength", 1, 10, 45, "45 to attribute per package.", "+", " to strength attribute"), '
            . '(3110, "resurgence", "Attributes", "Strikethrough Value", 1, 10, 45, "45% bonus per package to strikethrough value.", "", "% bonus to strikethrough value."), '
            . '(3200, "resurgence", "Combat", "Action Cost Reduction", 4, 2, 9, "9% bonus per package in reducing all action costs", "", "% bonus in reducing all action costs"), '
            . '(3201, "resurgence", "Combat", "Block Chance", 4, 2, 7, "7% bonus per package to block chance", "", "% bonus to block chance"), '
            . '(3202, "resurgence", "Combat", "Critical Hit", 4, 2, 7, "7% bonus per package to critical hit chance", "", "% bonus to critical hit chance"), '
            . '(3203, "resurgence", "Combat", "Critical Hit Defense", 4, 2, 7, "7% bonus per package to critical hit defense", "", "% bonus to critical hit defense"), '
            . '(3204, "resurgence", "Combat", "Devastation", 4, 2, 7, "7% increase per package on the amount of devastation.", "+", " increase to Devastation."), '
            . '(3205, "resurgence", "Combat", "Dodge Chance", 4, 2, 7, "7% bonus per package to dodge chance", "", "% bonus to dodge chance"), '
            . '(3206, "resurgence", "Combat", "Evasion Chance", 4, 2, 7, "7% bonus per package to evasion chance", "", "% bonus to evasion chance"), '
            . '(3207, "resurgence", "Combat", "Glancing Blow Increased", 4, 2, 7, "+7 increase to Glancing Blow Increased per package.", "+", " increase to Glancing Blow Increased."), '
            . '(3208, "resurgence", "Combat", "Glancing Blow Melee", 4, 2, 7, "+7 increase to Glancing Blow Melee per package.", "+", " increase to Glancing Blow melee."), '
            . '(3209, "resurgence", "Combat", "Glancing Blow Ranged", 4, 2, 7, "+7 increase to Glancing Blow Ranged per package.", "+", " increase to Glancing Blow Ranged."), '
            . '(3210, "resurgence", "Combat", "Heal Potency", 2, 5, 8, "Increase the strength of your heals by 8% per package.", "+", " increase to Heal Potency."), '
            . '(3211, "resurgence", "Combat", "Parry Chance", 4, 2, 7, "7% bonus per package to parry", "", "% bonus to parry"), '
            . '(3212, "resurgence", "Combat", "Second Chance", 2, 4, 6, "6% chance per package to automatically heal damage when hit in combat.", "", "% chance to automatically heal damage when struck in combat."), '
            . '(3213, "resurgence", "Combat", "Resilience", 2, 5, 8, "Reduce the amount of damage received by damage over time effects by 8% per package.", "Damage received by damage over time effects reduced by ", "%"), '
            . '(3214, "resurgence", "Combat", "Strikethrough Chance", 4, 2, 7, "7% bonus per package to strikethrough chance", "", "% bonus to strikethrough chance"), '
            . '(3300, "resurgence", "Miscellaneous", "Flush With Success", 2, 5, 3, "3% increase per package in the amount of experience earned.", "", "% increased experience gain."), '
            . '(3301, "resurgence", "Miscellaneous", "Beast Experience", 2, 5, 3, "3% increase per package in the amount of beast experience.", "+", " increase to Beast Experience."), '
            . '(3302, "resurgence", "Miscellaneous", "Go With The Flow", 2, 5, 5, "Increase all movement rates by 5% per package.", "", "% increase to all movement rates."), '
            . '(3400, "resurgence", "Resistances", "Elemental", 1, 5, 1800, "1800 to resistance per package", "", " to resistance per package"), '
            . '(3401, "resurgence", "Resistances", "Energy", 1, 5, 1800, "1800 to resistance per package", "+", " to Energy protection."), '
            . '(3402, "resurgence", "Resistances", "Kinetic", 1, 5, 1800, "1800 to resistance per package", "+", " to Kinetic protection."), '
            . '(3500, "resurgence", "Trade", "Amazing Success Chance", 4, 5, 0, "Increase in Amazing Success Chance per package.", "", "Increase in Amazing Success Chance."), '
            . '(3501, "resurgence", "Trade", "Crafting Ground Assemblies", 2, 5, 2, "2% increase per package on the amount of all ground crafting assemblies.", "+", " increase to all Ground Crafting Assemblies."), '
            . '(3502, "resurgence", "Trade", "Crafting Ground Experimentations", 2, 7, 2, "2% increase per package on the amount of all ground crafting experimentations.", "+", " increase to all Ground Crafting Experimentations."), '
            . '(3503, "resurgence", "Trade", "Crafting Space Assemblies", 2, 10, 50, "50% increase per package on the amount of all space crafting assemblies.", "+", " increase to all Space Crafting Assemblies."), '
            . '(3504, "resurgence", "Trade", "Crafting Space Experimentations", 2, 7, 2, "2% increase per package on the amount of all space crafting experimentations.", "+", " increase to all Space Crafting Experimentations."), '
            . '(3505, "resurgence", "Trade", "Creature Harvesting", 4, 2, 10, "10% increase per package on the amount of creature harvesting.", "+", " increase to Creature Harvesting."), '
            . '(3506, "resurgence", "Trade", "DNA Harvesting", 5, 10, 4, "4% increase per package on the amount of dna harvesting.", "+", " increase to DNA Harvesting."), '
            . '(3507, "resurgence", "Trade", "Factory Speed", 2, 5, 0, "Increase in Factory Speed per package.", "", "Increase in Factory Speed."), '
            . '(3508, "resurgence", "Trade", "Focused Enzyme Manipulation", 4, 10, 4, "4% increase per package on the amount of focused enzyme manipulation.", "+", " increase to Focused Enzyme Manipulation."), '
            . '(3509, "resurgence", "Trade", "Mutation Chance", 5, 2, 10, "Increase chance of mutated a pet during incubation session by 10%.", "Increase chance of mutated a pet during incubation session by ", "%"), '
            . '(3510, "resurgence", "Trade", "Reverse Engineering Chance", 2, 5, 4, "Increase strength of reverse engineering sessions by 4%.", "Increase strength of reverse engineering sessions by ", "%");'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE buffs');
    }
}
