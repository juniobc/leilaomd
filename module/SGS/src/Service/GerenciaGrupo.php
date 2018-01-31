<?php
namespace SGS\Service;

use SGS\Entity\Grupo;
use SGS\Entity\Telefone;
use SGS\Entity\MidiaSocial;
use SGS\Entity\Email;

class GerenciaGrupo{
	
	private $entityManager;
	 
	public function __construct($entityManager){
		
		$this->entityManager = $entityManager;
	
	}
	
	public function getAllGrupo(){
	
		/*$sql = "select * from t007 gpr"
		$sql .= " inner join  "
		
		$conn = $this->entityManager->getConnection();
		$stmt = $conn->prepare("select * from t007");
		//$stmt->bindValue(':value', $value);
		$stmt->execute();
		$result = $stmt->fetch();*/
	
	}
	
	public function addGrupo($data){
	
		if($this->checkGrupoExists($data['nm_grupo'])) {
            throw new \Exception("Já existe um grupo com o nome " . $data['nm_grupo']);
        }
		
		$grupo = new Grupo();
		$grupo->setNmGpr($data['nm_grupo']);
		$grupo->setDescAtuaGpr($data['desc_atua_gpr']);
		$grupo->setDescEmpresaGpr($data['desc_empresa_gpr']);
		$grupo->setDescMissaoGpr($data['desc_missao_gpr']);
		$grupo->setDescVisaoGpr($data['desc_visao_gpr']);
		$grupo->setDescValorGpr($data['desc_valor_gpr']);
		
		$this->entityManager->persist($grupo);
		
		$this->removeTelefones($grupo);
		$this->removeMidias($grupo);
		$this->removeEmails($grupo);
		
		$this->addTelToGrp($data, $grupo);
		
		$this->addMidiaSocialToGrp($data['link_facebook'], 'Facebook', $grupo);
		$this->addMidiaSocialToGrp($data['link_instagram'], 'Instagram', $grupo);
		$this->addMidiaSocialToGrp($data['link_google_plus'], 'Google Plus', $grupo);
		$this->addMidiaSocialToGrp($data['link_you_tube'], 'You Tube', $grupo);
		$this->addMidiaSocialToGrp($data['link_pinterest'], 'Pinterest', $grupo);
		$this->addMidiaSocialToGrp($data['link_twitter'], 'Twitter', $grupo);
		
		foreach($data['email_data'] as $key=>$value){
			$this->addEmailToGrp($value['descricao'], $value['email'], $grupo);
		}
		
		$this->entityManager->flush();
	}
	
	public function removeGrupo($grupo){
		
		$this->removeTelefones($grupo);
		$this->removeMidias($grupo);
		$this->removeEmails($grupo);
		
		$this->entityManager->remove($grupo);
		
		$this->entityManager->flush();
	
	}
	
	public function updateGrupo($grupo, $data){
	
		$grupo->setNmGpr($data['nm_grupo']);
		$grupo->setDescAtuaGpr($data['desc_atua_gpr']);
		$grupo->setDescEmpresaGpr($data['desc_empresa_gpr']);
		$grupo->setDescMissaoGpr($data['desc_missao_gpr']);
		$grupo->setDescVisaoGpr($data['desc_visao_gpr']);
		$grupo->setDescValorGpr($data['desc_valor_gpr']);
		
		$this->removeTelefones($grupo);
		$this->removeMidias($grupo);
		$this->removeEmails($grupo);
		
		$this->addTelToGrp($data, $grupo);
        
        $this->addMidiaSocialToGrp($data['link_facebook'], 'Facebook', $grupo);
		$this->addMidiaSocialToGrp($data['link_instagram'], 'Instagram', $grupo);
		$this->addMidiaSocialToGrp($data['link_google_plus'], 'Google Plus', $grupo);
		$this->addMidiaSocialToGrp($data['link_you_tube'], 'You Tube', $grupo);
		$this->addMidiaSocialToGrp($data['link_pinterest'], 'Pinterest', $grupo);
		$this->addMidiaSocialToGrp($data['link_twitter'], 'Twitter', $grupo);
		
		foreach($data['email_data'] as $key=>$value){
			$this->addEmailToGrp($value['descricao'], $value['email'], $grupo);
		}
		
		$this->entityManager->flush();
		
    }
	
    public function checkGrupoExists($nmGpr) {
        
        $grupo = $this->entityManager->getRepository(Grupo::class)->findOneByNmGpr($nmGpr);        
        return $grupo !== null;
    }
	
	private function removeTelefones($grupo){
		$telefones = $grupo->getTelefones();
		foreach ($telefones as $telefone) {            
			$grupo->removeTelefoneAssociation($telefone);
		}
	}
	
	private function addTelToGrp($data, $grupo){
		
		$dddTelFixo = substr($data['nr_tel_fixo'],0,3);
		$nrTelFixo = substr($data['nr_tel_fixo'],3,8);
				
		$telFixo = $this->entityManager->getRepository(Telefone::class)->findOneBy(['dddTel' => $dddTelFixo,'nrTel' => '$nrTelFixo']);
		
		if ($telFixo == null)		
			$telFixo = new Telefone();
		
		$telFixo->setNmTel("FIXO");
		$telFixo->setTpTel(0);
		$telFixo->setDddTel($dddTelFixo);
		$telFixo->setNrTel($nrTelFixo);
		$telFixo->addGrupo($grupo);
		
		$this->entityManager->persist($telFixo);
		
		$grupo->addTelefone($telFixo);
		
		$dddTelWhats = substr($data['nr_tel_whats'],0,3);
		$nrTelWhats = substr($data['nr_tel_whats'],3,9);
		
		$telWhats = $this->entityManager->getRepository(Telefone::class)->findOneBy(array('dddTel' => $dddTelWhats, 'nrTel' => $nrTelWhats));
		
		if ($telWhats == null)		
			$telWhats = new Telefone();
		
		$telWhats->setNmTel("WHATSAPP");
		$telWhats->setTpTel(1);
		$telWhats->setDddTel($dddTelWhats);
		$telWhats->setNrTel($nrTelWhats);
		$telWhats->addGrupo($grupo);
		
		$this->entityManager->persist($telWhats);
		
		$grupo->addTelefone($telWhats);
		
	}
	
	private function removeMidias($grupo){
		$midiasSocial = $grupo->getMidiasSocial();
		foreach ($midiasSocial as $midiaSocial) {            
			$grupo->removeMidiaSocialAssociation($midiaSocial);
		}
	}
	
	private function addMidiaSocialToGrp($link, $desc, $grupo){
		
		$link = strtoupper($link);
		$desc = strtoupper($desc);
		
		$midiaSocial = $this->entityManager->getRepository(MidiaSocial::class)->findOneBy(['linkMdSoc' => $link,'descMdSoc' => $desc]);
		
		if ($midiaSocial == null)
			$midiaSocial = new MidiaSocial();
		
		$midiaSocial->setLinkMdSoc($link);
		$midiaSocial->setDescMdSoc($desc);
		
		$this->entityManager->persist($midiaSocial);
		
		$grupo->addMidiaSocial($midiaSocial);
		
	}
	
	private function removeEmails($grupo){
		$emails = $grupo->getEmails();
		foreach ($emails as $email) {            
			$grupo->removeEmailAssociation($email);
		}
	}
	
	private function addEmailToGrp($desc, $endEmail, $grupo){
		
		$desc = strtoupper($desc);
		$endEmail = strtoupper($endEmail);
		
		$email = $this->entityManager->getRepository(Email::class)->findOneBy(['descEmail' => $desc,'endEmail' => $endEmail]);
		
		if ($email == null)
			$email = new Email();
		
		$email->setDescEmail($desc);
		$email->setEndEmail($endEmail);
				
		$this->entityManager->persist($email);
		
		$grupo->addEmail($email);
		
	}
	
}