import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EncargadoComponent } from './encargado.component';

describe('EncargadoComponent', () => {
  let component: EncargadoComponent;
  let fixture: ComponentFixture<EncargadoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EncargadoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EncargadoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
